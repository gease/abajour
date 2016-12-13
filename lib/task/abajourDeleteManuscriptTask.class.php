<?php
/**
 * delete manuscript task
 *
 * Удаление рукописи и всех связанных с ней данных
 *
 * @package    abajour
 * @subpackage lib.task
 * @author     Vadim Valuev
 * @version    SVN: $Id: abajourDeleteManuscriptTask.class.php 183 2010-03-17 17:14:40Z я $
 */

class abajourDeleteManuscriptTask extends sfBaseTask
{
    protected function configure()
    {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));
        $this->addArguments(array(
            new sfCommandArgument('id', sfCommandArgument::REQUIRED, 'Manuscript id'),
        ));
    	
        $this->addOptions(array(
        new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
        new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
        new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'propel')
        // add your own options here
        ));

        $this->namespace        = 'abajour';
        $this->name             = 'delete-manuscript';
        $this->briefDescription = 'Permanently delete manuscript with given ID';
        $this->detailedDescription = <<<EOF
            The [abajour:delete-manuscript|INFO] deletes manuscript
            Call it with:
            [php symfony abajour:delete-manuscript %id%|INFO]
EOF;
  }
  
  public function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'] ? $options['connection'] : null)->getConnection();
    $manuscript = manuscriptPeer::retrieveByPK($arguments['id']);
    if (!$manuscript) {
    	$this->logSection("do", "unable to find: ".$arguments['id']);
    	return;
    }
    /* @var $manuscript manuscript*/
    //убрать файлы
    if (!$this->askConfirmation("Do you really want to permanently delete manuscript entitled ".
            mb_convert_encoding($manuscript,'cp866','utf-8'))) return;
    $manuscript->delete();
  }
}
?>
