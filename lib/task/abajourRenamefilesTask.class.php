<?php
/**
 * rename manuscript task
 *
 * Переименование файлов в новую нотацию ид_манускрипта_ид_акции
 *
 * @package    abajour
 * @subpackage lib.task
 * @author     Vadim Valuev
 * @version    SVN: $Id: abajourRenamefilesTask.class.php 184 2010-03-23 14:38:51Z я $
 */

class abajourRenamefilesTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel'),
      new sfCommandOption('lag', null, sfCommandOption::PARAMETER_OPTIONAL, 'Time lag allowed between action and file creation', 10),
      new sfCommandOption('shift', null, sfCommandOption::PARAMETER_OPTIONAL, 'Time shift between database and filesystem, hrs', 0),
      new sfCommandOption('backup', null, sfCommandOption::PARAMETER_OPTIONAL, 'Save backup copy', true),
      new sfCommandOption('backup_dir', null, sfCommandOption::PARAMETER_OPTIONAL, 'Directory for backup', 'backup'),
      new sfCommandOption('test', null, sfCommandOption::PARAMETER_OPTIONAL, 'Running in test mode', false)
      // add your own options here
    ));

    $this->namespace        = 'abajour';
    $this->name             = 'rename-files';
    $this->briefDescription = 'Rename manuscript files to new notation using action_id';
    $this->detailedDescription = <<<EOF
The [abajour:rename-files|INFO] renames manuscript files from old notation using authors and manuscripts to notatiion that uses action_id
Call it with:

  [php symfony abajour:rename-files|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    $c = new Criteria();
    $manuscripts = manuscriptPeer::doSelect($c, $connection);
    $c->add(actionPeer::STATUS_BEFORE,manuscriptPeer::CREATED);
    $c->addOr(actionPeer::STATUS_BEFORE,manuscriptPeer::UNDER_REWRITE);
    foreach ($manuscripts as $manuscript)
    {
    	/* @var $manuscript manuscript */
        $filesdata = $manuscript->getFilesNumber(0);
        $actions = $manuscript->getactions($c);
        $n = count($filesdata);
        if ($n>0) $matches = array_fill(0, $n, -1);
        else $matches = array();
//        echo mb_convert_encoding($manuscript,'cp866','utf-8')."\n";
        for ($i=0; $i<$n; $i++)
        {
        	for ($j=0; $j<count($actions); $j++)
        	{
//        	   echo strftime('%Y-%m-%d %H.%M.%S', $filesdata[$i]['date']);
//        	   echo '-----';
//        	   echo strftime('%Y-%m-%d %H.%M.%S', $actions[$j]->getDatetime('U'))."\t";
//        	   //echo strftime('%Y-%m-%d %H.%m', $actions[$j]->getDatetime('%s'))."\n";
        	   $dd = $filesdata[$i]['date']+$options['shift']*3600- $actions[$j]->getDatetime('U');
//        	   echo $dd."\t".$options['lag']."\n";
        	   if (abs($dd)<$options['lag'])
        	   {
        	   	   if ($matches[$i]!=-1) $this->logSection('do', 'Duplicate file in: '.$manuscript->getId().'  '.mb_convert_encoding($manuscript,'cp866','utf-8'), null, 'ERR');
        	   	   else
        	   	   {
        	   	       if (in_array($j, $matches)) $this->logSection('do', 'One action for several files in: '.$manuscript->getId().'  '.mb_convert_encoding($manuscript,'cp866','utf-8'), null, 'ERR');
        	   	   	   $matches[$i]=$j;
        	   	   }
        	   }
        	}
        }
        if (!(array_search(-1, $matches)===false))
        {
        	$this->logSection('do', 'Orphaned file in: '.$manuscript->getId().'  '.mb_convert_encoding($manuscript,'cp866','utf-8'), null, 'ERROR');
        	for ($i=0; $i<$n; $i++)
        	   if ($matches[$i]>-1) $this->logSection('do', $filesdata[$i]['filename'].'  '.strftime('%Y-%m-%d %H.%M.%S', $filesdata[$i]['date']).'---'.strftime('%Y-%m-%d %H.%M.%S', $actions[$matches[$i]]->getDatetime('U')), null, 'ERR');
        	   else $this->logSection('do', $filesdata[$i]['filename'].'  '.strftime('%Y-%m-%d %H.%M.%S', $filesdata[$i]['date']).'---', 500, 'ERR');
        }
        elseif (!$options['test'])
        {
        	for ($i=0; $i<$n; $i++)
        	{
        		$dir = dirname($filesdata[$i]['filename']);
        		if ($options['backup'])
        		{
        			$file = basename($filesdata[$i]['filename']);
        			$filepath = $dir.DIRECTORY_SEPARATOR.$options['backup_dir'].DIRECTORY_SEPARATOR.$file;
        			$this->getFilesystem()->copy($filesdata[$i]['filename'], $filepath);
        			touch($filepath, $filesdata[$i]['date'], $filesdata[$i]['date']);
        		}
        		$ext = strstr($filesdata[$i]['filename'], '.');
        		$new_name = $dir.DIRECTORY_SEPARATOR.$manuscript->generateFilename($actions[$matches[$i]]).$ext;
        		$this->getFilesystem()->rename($filesdata[$i]['filename'], $new_name);
        	}
        }
     }
  }
}
