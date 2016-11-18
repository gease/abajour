<?php
//require_once('C:\php5\PEAR\symfony\plugins\sfPropelPlugin\lib\task\sfPropelBaseTask.class.php');

class portDataTask extends sfPropelBaseTask{

  protected $log_encoding;

  protected function configure()
  {
    $this->namespace        = 'abajour';
    $this->name             = 'portData';
    $this->briefDescription = 'generates sql from initial data';
    $this->log_encoding = '';
    $this->detailedDescription = <<<EOF
The [portData|INFO] task generates sql files to populate database with initial data from Access tables.
Call it with:

  [php symfony portData|INFO]
EOF;
    // add arguments here, like the following:
    //$this->addArgument('application', sfCommandArgument::REQUIRED, 'The application name');
    // add options here, like the following:
    $this->addOption('env', null, sfCommandOption::PARAMETER_OPTIONAL, 'The environment', 'dev');
    $this->addArgument('application', sfCommandArgument::OPTIONAL, 'Changes the application context of the task', 'frontend');
  }

  protected function console_convert($text,$dummy1=1,$dummy2=2){
         if (empty($this->log_encoding)){
             return $text;
         } else {
             return mb_convert_encoding($text,'cp866','utf-8');
         }
  }

  protected function execute($arguments = array(), $options = array())
  {
  	/*
  	 * План.
  	 * 1. Заселить рецензентами из таблицы "Рецензенты"
  	 * 2. Парсить авторов из таблицы Портфель
  	 *   Сначала смотреть автора по переписке
  	 *  Полное совпадение фамилии и совпадение имени и начала по крайней мере имени в рецензентах и авторах
  	 *  Записывать в лог случаи частичного совпадения?
  	 *
  	 *    Совпадение фамилии, инициалов
  	 *
  	 */
  	//1. Файл с рецензентами открыть
  	//$this->logSection('do','starting');
    $infile = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR. 'raw'.DIRECTORY_SEPARATOR.'Reviewers.txt';
	$fin = fopen($infile, 'r');
	$databaseManager = new sfDatabaseManager($this->configuration);
	$this->logSection('do', 'populating started');
        mb_regex_encoding('utf-8');
        mb_internal_encoding('utf-8');
//    require_once(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'form/profileAdminForm.class.php');
//    require_once(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'model/manuscript.php');
//     require_once(sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'model/om/Basemanuscript.php');
//     require_once('C:\php5\PEAR\symfony\plugins/sfPropelPlugin/lib/vendor/propel/om/BaseObject.php');
     sfContext::createInstance($this->configuration);
    //$autoload = sfSimpleAutoload::getInstance();
    //$autoload->addDirectory(sfConfig::get('sf_lib_dir'));
   // $autoload->reload();
    if (strstr($_SERVER['OS'], 'Windows')) $this->log_encoding = 'cp866';
//    $string=fgets($fin);
//	while ($string=fgets($fin))
//	{
//		$fields = split(';', $string);
//		$values = array();
//		$values['last_name'] = trim($fields[1], '" ');
//		$values['first_name'] = trim($fields[2], '" ');
//		$values['middle_name'] = trim($fields[3], '" ');
//		$gender = trim($fields[4], '" ');
//		$values['address'] = trim($fields[5], '" ');
//		$values['email'] = trim($fields[6], '" ');
//		$values['phone_home'] = trim($fields[7], '" ');
//		$values['phone_work'] = trim($fields[8], '" ');
//
//		if (stristr($gender, 'ж')) $values['gender']='F';
//		else $values['gender']='M';
//          $this->logSection('do', 'parsing '.$this->console_convert($values['last_name']));
//        $validator = new sfValidatorEmail();
//        try
//        {
//            $values['email'] = $validator->clean($values['email']);
//        }
//        catch (sfValidatorError $e) {
//        	//echo $e;
//        	unset($values['email']);
//        }
//
//		$form = new profileAdminForm();
//		$validator_schema = $form->getValidatorSchema();
//		$validator_schema['address']->addOption('required', false);
//		$defaults = $form->getDefaults();
//		$values = array_merge($defaults, $values);
//		$values['is_reviewer'] = true;
//		$form->bind($values);
//		if ($form->isValid())
//		{
//			$form->save();
//		}
//		else
//		{
//		  foreach ($form as $key=>$field)
//		  {
//		  	if ($field->hasError()) {echo $key; exit;}
//		  }
//		}
//	}
//	fclose($fin);
	
	//Теперь таблица "Портфель"
	$infile = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR. 'raw'.DIRECTORY_SEPARATOR.'Stock.txt';
    $fin = fopen($infile, 'r');
	$this->logSection('do', 'Opened stock file');
	$pat_linestart = '^\d+\174';
	$pat_linestart1 = '/^\p{Nd}+\174/u';
	$pat_author = '/^(?P<surname>(\p{Ll}+[\x20\'-]+)*(\p{Lu}\p{Ll}*)(-\p{L}+)*)(\s)+(?P<first>\p{Lu}\p{Ll}*(\.)?)(?P<middle>([- ]*\p{Lu}\p{Ll}*(?(7)\.|\.?))*)$/u';
	$new_line = fgets($fin);
	$string=fgets($fin);

    do
    {
    	
    	//сшить строчки
        if (mb_ereg_match($pat_linestart, $string))
        {
        	$line = $new_line;
        	$new_line = $string;  //Начинаем новую, обрабатываем предыдущую
        	//echo $line;
        	$err = false;
        	$fields = mb_split('\174', $line);
//        	if (count($fields)!=39) {echo $fields[0].' has '.count($fields)."\n";}
//        	else echo $fields[0]."\n";
            $corresponding = array();
            //1. Поднять автора по переписке и убедиться, что он есть среди авторов
            $corresponding['last_name']=trim($fields[7],'" .');
            $corresponding['first_name']=trim($fields[8],'" .');
            $corresponding['middle_name']=trim($fields[9],'" .');
            $reviewer1_string = trim($fields[5], '" .');
            $reviewer2_string = trim($fields[6], '" .');
            $authors_string = trim($fields[38],"\x0A\x0D\"\x20");
            if (empty($authors_string)) $authors_string = trim($fields[2], '" ');
            //Парсим авторов
            //Убрать комменты в скобках
            if ($pos = mb_strpos($authors_string, '(')) $authors_string = mb_substr($authors_string, 0, $pos);
            //Разделить по запятым
            $authors = array();
            $author_fields = array();
            $author_fields = mb_split(',', $authors_string);
            //Выкинуть пустые
            for ($i=0; $i<count($author_fields); $i++)
            {
            	$author_fields[$i] = trim($author_fields[$i]);
            	if (preg_match('/^\P{L}*$/u', $author_fields[$i]))
            	{
            		for ($k=$i; $k<count($author_fields)-1; $k++)
            		{
            			$author_fields[$k] = $author_fields[$k+1];
            		}
            		array_pop($author_fields);
            		$i--;
            	}
            }
            //Проверить правильность
            foreach ($author_fields as $num => $author)
            {
            	$matches = array();
            	if (!preg_match_all($pat_author, $author, $matches))
            	{
            		$this->logSection('err', $fields[0].' '.$num.' '.$this->console_convert($author));
            		//$this->askConfirmation('right?');
            		$err = true;
            	}
            	else
            	{
            	   $authors[$num]['last_name'] = $matches['surname'][0];
            	   $authors[$num]['first_name'] = trim($matches['first'][0], " .");
            	   $authors[$num]['middle_name'] = trim($matches['middle'][0], "- .");
//            	   $this->logSection('do', $fields[0].' '.$num.' '.$this->console_convert($matches['surname'][0].' '.$matches['first'][0], 'CP866','UTF-8'));
//            	   $this->askConfirmation('right?');
            	}
            }
            if ($err) continue;
            //Убедиться, что корреспондинг - среди авторов
            $corr_num = -1;
            for ($i = 0; $i<count($authors); $i++ )
            {
            	if (self::match_person($corresponding, $authors[$i])) {$corr_num = $i; break;}
            }
                                  
            if ($corr_num == -1)
            {
            	$err = true;
            	$this->logSection('err', $fields[0].' corresponding not found');
                //$this->askConfirmation('right?');
            }
            //Поднять рецензента
            $reviewer1 = array();
            $reviewer2 = array();
            //Убрать комменты в скобках
            if ($pos = mb_strpos($reviewer1_string, '(')) $reviewer1_string = mb_substr($reviewer1_string, 0, $pos);
            if ($pos = mb_strpos($reviewer2_string, '(')) $reviewer2_string = mb_substr($reviewer2_string, 0, $pos);
            //Убедиться, что рецензент есть в базе
            if (!empty($reviewer1_string))
            {
            	list($reviewer1['last_name'], $reviewer1['first_name'], $reviewer1['middle_name']) = mb_split("[\s.]+", $reviewer1_string);
            	array_map('trim', $reviewer1, array(". ", ". "," ."));
            	//$this->logSection('do', $fields[0].' reviewer '.$this->console_convert($reviewer1['last_name'], 'CP866','UTF-8'));
            	$c = new Criteria();
            	$c->add(sfGuardUserProfilePeer::LAST_NAME, $reviewer1['last_name']);
            	$c->add(sfGuardUserProfilePeer::FIRST_NAME, $reviewer1['first_name'].'%', Criteria::LIKE);
            	$c->add(sfGuardUserProfilePeer::IS_REVIEWER, true);
            	$result = sfGuardUserProfilePeer::doSelectOne($c);
            	if (empty($result))
            	{
            	   $err=true;
            	   $this->logSection('err', $fields[0].' no reviewer '.$this->console_convert($reviewer1['last_name'].' '.$reviewer1['first_name']));
            	}
            	else $reviewer1_id = $result->getId();
            	//Убедиться в наличии дат отправки на рецензию и получения рецензии и их валидности (поля 26, 27)
            	
            }
            if (!empty($reviewer2_string))
            {
                list($reviewer2['last_name'], $reviewer2['first_name'], $reviewer2['middle_name']) = mb_split("[\s.]+", $reviewer2_string);
                array_map('trim', $reviewer2, array(". ", ". "," ."));
                //$this->logSection('do', $fields[0].' reviewer '.$this->console_convert($reviewer1['last_name'], 'CP866','UTF-8'));
                $c = new Criteria();
                $c->add(sfGuardUserProfilePeer::LAST_NAME, $reviewer2['last_name']);
                $c->add(sfGuardUserProfilePeer::FIRST_NAME, $reviewer2['first_name'].'%', Criteria::LIKE);
                $c->add(sfGuardUserProfilePeer::IS_REVIEWER, true);
                $result = sfGuardUserProfilePeer::doSelectOne($c);
                if (empty($result))
                {
                   $err=true;
                   $this->logSection('err', $fields[0].' no reviewer '.$this->console_convert($reviewer1['last_name'].' '.$reviewer1['first_name']));
                }
                else $reviewer2_id = $result->getId();
                //Убедиться в наличии дат отправки на рецензию и получения рецензии и их валидности (поля 26, 27)
                
            }
            else $reviewer2_id  = sfGuardUserPeer::retrieveByUsername('admin')->getId();
            //if ($err) continue;
            //Проверить состояние
            $status = trim($fields[32],' "');
            $status_array = array(
                'Опубликована',
                "Отказано в публикации",
                "Отправлена на переработку",
                "Ждет решения редколлегии",
                "Находится на рецензии",
                "Получена",
                "У реценз. после перераб.",
                "Принята к публикации"
            );
            if (!in_array($status, $status_array))
            {
                $err=true;
                $this->logSection('err', $fields[0].' incorrect status '.$this->console_convert($status));
            }
            //Проверить e-mail
            $email_string = trim($fields[15], ' ",:');
            $email = '';
            if (!empty($email_string))
            {
            	$emails = mb_split('[\s;,\(]+', $email_string);
            	$email = $emails[0];
            }
            $validator = new sfValidatorEmail(array('required'=>false));
            try
            {
                $email = $validator->clean($email);
            }
            catch (sfValidatorError $e)
            {
                $this->logSection('err', $fields[0].' invalid email '.$this->console_convert($email));
                $err = true;
            }
            //Страна
            $country_string = trim($fields[10], '" ');
            $country_array = array (
               'RU'=> "Россия",
               'AZ'=> "Азербайджан",
               'AM'=> "Армения",
               'KZ'=> "Казахстан",
               'KG'=> "Кыргызстан",
               'UZ'=> "Узбекистан",
               'UA'=> "Украина",
               'CN'=> "China",
               'CM'=> "Cameroon",
               'CZ'=> "Czech republic",
               'IN'=> "India",
               'NL'=> "Netherlands",
               'MY'=> "Malaysia",
               'TH'=> "Thailand",
               'TN'=> "Tunis",
               'TR'=> "Turkey",
               'US'=> "USA",
               'DE'=> "Germany",
               'GB'=> "Великобритания"
            );
            if (!in_array($country_string, $country_array))
            {
            	$this->logSection('err', $fields[0].' invalid country '.$this->console_convert($country_string, 'CP866','UTF-8'));
                $err = true;
            }
            else {
            	$country = array_search($country_string, $country_array);
            }
            //Город
            $city_string = trim($fields[12], '" ,');
            $city_pattern = '/^\p{Lu}\p{Ll}+([-\s]\p{Lu}?\p{Ll}+)*$/u';
            $city = ($city_string == 'ИВТ СО РАН')? "Новосибирск" : $city_string;
            if (!preg_match($city_pattern, $city))
            {
                $this->logSection('err', $fields[0].' invalid city '.$this->console_convert($city, 'CP866','UTF-8'));
                $err = true;
            }
            //Результат рецензии
            $outcome1_string = trim($fields[28], '" ');
            $outcome2_string = trim($fields[31], '" ');
            $outcome_array = array(
                "Положительная",
                "Отрицательная",
                "Требует ответа автора",
                "Возвращена без рец."
            );
            if ((!empty($outcome1_string) && !in_array($outcome1_string, $outcome_array)) ||
                (!empty($outcome2_string) && !in_array($outcome2_string, $outcome_array)))
            {
            	$this->logSection('err', $fields[0].' invalid outcome '.$this->console_convert($outcome1_string, 'CP866','UTF-8'));
                $err = true;
            }
            //Actions
            $submitted_date = date_create(trim($fields[19], '" '));
            $rewrite_date_string = trim($fields[20], '" ');
            $rewrite_date   = date_create($rewrite_date_string);
            $review1_sent_string = trim($fields[26], '" ');
            $review1_sent   = date_create($review1_sent_string);
            $review1_received_string = trim($fields[27], '" ');
            $review1_received   = date_create($review1_received_string);
            $review2_sent_string = trim($fields[29], '" ');
            $review2_sent   = date_create($review2_sent_string);
            $review2_received   = date_create(trim($fields[30], '" '));
            $published_string = trim($fields[33], '" ');
            $published_date = date_create($published_string.'-12-31');
            //Записывать в базу
            if (!$err)
            {
            	//1.Записать в базу автора для переписки
            	//2. Для каждого автора проверить наличие его в базе
            	//3.Сравнить полноту информации и перезаписать при необходимости
            	//4. Записать статью
            	//5. Рецензия
            	//6. Действия (actions)
            	//Поиск по полному имени и фамилии
            	$corr_user = self::getObject($corresponding);
                if (!$corr_user)
            	{
            	      $err=true;
            		  $this->logSection('err', $fields[0].' not matching person in db '.$this->console_convert($corresponding['last_name'], 'CP866','UTF-8'));
            	}
                if ($err) continue;
            	$corr_user->setAddress(trim($fields[11], '" ').', '.trim($fields[12], '" ').', '.trim($fields[13], '" '));
            	$corr_user->setInstitution(trim($fields[14], '" '));
            	$corr_user->setCountry($country);
            	if (!empty($email)) $corr_user->setEmail($email);
            	//город
            	$city_obj = cityPeer::retrieveByName($city);
            	$corr_user->setcity($city_obj);
            	//$corr_user->save();
            	//То же самое для всех остальных авторов
            	$auth_users = array();

            	for ($i = 0; $i<count($authors); $i++ )
            	{
            		if ($i == $corr_num) $auth_users[$i] = $corr_user;
            		else {
            		  $auth_users[$i] = self::getObject($authors[$i]);
            		  if (!$auth_users[$i])
            		  {
            			 $err = true;
            			 $this->logSection('err', $fields[0].' not matching person in db '.$this->console_convert($authors[$i]['last_name'], 'CP866','UTF-8'));
            		  }
            		}
            	}
            	if ($err) continue;
            	//Создаём манускрипт
            	$c = new Criteria();
            	$c->add(manuscriptPeer::TITLE, trim($fields[4], '" '));
            	$manuscript = manuscriptPeer::doSelectOne($c);
            	if (is_null($manuscript)) $manuscript = new manuscript();
            	else $manuscript->flush();
            	$manuscript->setTitle(trim($fields[4], '" '));
            	$manuscript->setcity($city_obj);
            	for ($i = 0; $i<count($auth_users); $i++ )
            	{
            		$manuscript->addAuthor($auth_users[$i], $i, ($i == $corr_num));
            	}
            	//actions
            	$manuscript->setStatus(manuscriptPeer::SUBMITTED, $submitted_date);
            	if (!empty($review1_sent_string)) $manuscript->setStatus(manuscriptPeer::UNDER_REVIEW, $review1_sent);
            	if (!empty($review1_received_string))
            	{
            		if ($outcome1_string == 'Требует ответа автора') $manuscript->setStatus(manuscriptPeer::UNDER_REWRITE, $review1_received);
            		elseif ($outcome1_string == 'Отрицательная') $manuscript->setStatus(manuscriptPeer::REJECT, $review1_received);
            		elseif ($outcome1_string == 'Положительная') $manuscript->setStatus(manuscriptPeer::PENDING, $review1_received);
            		elseif ($outcome1_string == 'Возвращена без рец.') $manuscript->setStatus(manuscriptPeer::REVIEWER_REFUSED, $review1_received);
            	}
            	if (!empty($rewrite_date_string))
            	{
            	   if (!empty($review2_sent_string) && $reviewer1_id != $reviewer2_id) $manuscript->setStatus(manuscriptPeer::REVIEWER_REJECT, $rewrite_date);
            	   elseif (!empty($review2_sent_string)) $manuscript->setStatus(manuscriptPeer::REVIEW_FINAL, $rewrite_date);
            	   else $manuscript->setStatus(manuscriptPeer::REVIEW_FINAL, $rewrite_date);
            	}
            	if (!empty($review2_sent_string))
            	{
            		$manuscript->setStatus(manuscriptPeer::UNDER_REVIEW, $review2_sent);
                    if ($outcome2_string == 'Требует ответа автора') $manuscript->setStatus(manuscriptPeer::UNDER_REWRITE, $review2_received);
                    elseif ($outcome2_string == 'Отрицательная') $manuscript->setStatus(manuscriptPeer::REJECT, $review2_received);
                    elseif ($outcome2_string == 'Положительная') $manuscript->setStatus(manuscriptPeer::PENDING, $review2_received);
                    elseif ($outcome2_string == 'Возвращена без рец.') $manuscript->setStatus(manuscriptPeer::REVIEWER_REFUSED, $review2_received);
                }
                if ($status == 'Опубликована')
                {
                	$manuscript->setStatus(manuscriptPeer::PUBLISHED, $published_date);
                	/* @var $publication Publication */
                	$publication = $manuscript->getPublication();
                	if (is_null($publication))
                	{
                		$publication = new Publication();
                		$manuscript->setPublication($publication);
                	}
                	$publication->setYear($published_string);
                	$publication->setVolume(trim($fields[34], '" '));
                	$publication->setNumber(trim($fields[35], '" '));
                	$publication->setFirstPage(trim($fields[36], '" '));
                	$publication->setLastPage(trim($fields[37], '" '));
                }
                switch($status)
                {
                    case 'Опубликована': $status_correct = manuscriptPeer::PUBLISHED; break;
                    case "Отказано в публикации": $status_correct = manuscriptPeer::REJECT; break;
                    case "Отправлена на переработку": $status_correct = manuscriptPeer::UNDER_REWRITE; break;
                    case "Ждет решения редколлегии": $status_correct = manuscriptPeer::PENDING; break;
                    case "Находится на рецензии": $status_correct = manuscriptPeer::UNDER_REVIEW; break;
                    case "Получена": $status_correct = manuscriptPeer::SUBMITTED; break;
                    case "У реценз. после перераб.": $status_correct = manuscriptPeer::UNDER_REVIEW; break;
                    case "Принята к публикации": $status_correct = manuscriptPeer::ACCEPTED_PUBL; break;
                    default: $status_correct = manuscriptPeer::CREATED;
                }
                if ($manuscript->getStatus() != $status_correct) $manuscript->setStatus($status_correct);
                //добавить рецензии
                //проверить наличие рецензента1
                if (!empty($reviewer1))
                {
                    $review = reviewPeer::retrieveByPK($reviewer1_id, $manuscript->getId());
                	if (is_null($review))
                	{
                		$review = new review();
                        $review->setmanuscript($manuscript);
                        $review->setUserId($reviewer1_id);
                	}
                    if ($outcome1_string == 'Требует ответа автора') $review->setOutcome(reviewPeer::ACCEPT_COMMENT, $review1_received);
                    elseif ($outcome1_string == 'Отрицательная') $review->setOutcome(reviewPeer::REJECT, $review1_received);
                    elseif ($outcome1_string == 'Положительная') $review->setOutcome(reviewPeer::ACCEPT, $review1_received);
                    elseif ($outcome1_string == 'Возвращена без рец.') $review->setOutcome(reviewPeer::REFUSED_REVIEW, $review1_received);
                    else $review->setSubmitted($review1_sent);
                }
                               
                
                if ($review2_sent_string )
                {
                	if ($reviewer1_id != $reviewer2_id)
                	{
                	$review = reviewPeer::retrieveByPK($reviewer2_id, $manuscript->getId());
                    if (is_null($review))
                    {
                        $review = new review();
                        $review->setmanuscript($manuscript);
                        $review->setUserId($reviewer2_id);
                    }
                    if ($outcome2_string == 'Требует ответа автора') $review->setOutcome(reviewPeer::ACCEPT_COMMENT, $review2_received);
                        elseif ($outcome2_string == 'Отрицательная') $review->setOutcome(reviewPeer::REJECT, $review2_received);
                        elseif ($outcome2_string == 'Положительная') $review->setOutcome(reviewPeer::ACCEPT, $review2_received);
                        elseif ($outcome2_string == 'Возвращена без рец.') $review->setOutcome(reviewPeer::REFUSED_REVIEW, $review2_received);
                        else $review->setSubmitted($review2_sent);
                	}
                	else
                	{
                		if ($outcome2_string == 'Отрицательная') $review->setDecision(0);
                        elseif ($outcome2_string == 'Положительная') $review->setDecision(1);
                	}
                }
            	$manuscript->save();
            }
            
        }
        else
        {
        	///echo $this->console_convert($string, 'CP866','UTF-8');
        	//$this->logSection('err','long line');
        	$new_line .= ' '.$string;
        }
    } while ($string=fgets($fin));
	
		//else $this->logSection('err', $this->console_convert($values['last_name'].' not saved due to some errors','CP866','UTF-8'));
//
//		/*$pat = '/^[\p{L}\s]+$/u';
//		if (preg_match($pat, $l_name))
//		{
//			$c = new Criteria();
//			$c->add(sfGuardUserPeer::USERNAME, $l_name);
//			$user = sfGuardUserPeer::doSelectOne($c);
//
//			if (empty($user))
//			{
//				$user = new sfGuardUser();
//				$userProfile = new sfGuardUserProfile();
//				$user->setUsername($l_name);
//				$user->setPassword('111');
//				$userProfile->setFirstName($f_name);
//				$userProfile->setLastName($l_name);
//				if ($m_name) $userProfile->setMiddleName($m_name);
//				$userProfile->setsfGuardUser($user);
//				$user->save();
//				$userProfile->save();
//			}
//			$manuscript = new manuscript();
//			$manuscript->setTitle($title);
//			$xref = new userManuscriptRef();
//			$xref->setmanuscript($manuscript);
//			$xref->setsfGuardUser($user);
//			$this->logSection('port', $user->getUsername());
//			$manuscript->save();
//			$xref->save();
//			$user->save();
//		}*/
    sfContext::getInstance()->shutdown();
	}
	
	protected function match_person ( $first_person, $second_person )
	{
		$first = array();
		$second = array();
		if (!is_array($first_person))
		{
			$first['last_name'] = $first_person->getLastName();
			$first['first_name'] = $first_person->getFirstName();
			$first['middle_name'] = $first_person->getMiddleName();
		}
		else $first = $first_person;
		if (!is_array($second_person))
        {
            $second['last_name'] = $second_person->getLastName();
            $second['first_name'] = $second_person->getFirstName();
            $second['middle_name'] = $second_person->getMiddleName();
        }
        else $second = $second_person;
		
		//Сравнить фамилии
		if ($first['last_name'] != $second['last_name']) return false;
		//Сравнить имена
		if (!mb_strstr($first['first_name'], $second['first_name']) && !mb_strstr($second['first_name'], $first['first_name']) ) return false;
		//Сравнить отчества по первой букве
		if (isset($first['middle_name']) && isset($second['middle_name']) &&
		      mb_substr($first['middle_name'], 0, 1) != mb_substr($second['middle_name'], 0, 1)) return false;
		return true;
	}
	
	protected function getObject (array $author)
	{
	   $c = new Criteria();
       $c->add(sfGuardUserProfilePeer::LAST_NAME, $author['last_name']);
       $c->add(sfGuardUserProfilePeer::FIRST_NAME, $author['first_name']);
       if (!empty($author['middle_name'])) $c->add(sfGuardUserProfilePeer::MIDDLE_NAME, $author['middle_name']);
       $selected_num = sfGuardUserProfilePeer::doCount($c);
       //Поиск по фамилии и инициалам
       if (!$selected_num)
       {
            $c->add(sfGuardUserProfilePeer::FIRST_NAME, mb_substr($author['first_name'], 0, 1).'%', Criteria::LIKE);
            if (!empty($author['middle_name']))
                    $c->add(sfGuardUserProfilePeer::MIDDLE_NAME, mb_substr($author['middle_name'], 0, 1).'%', Criteria::LIKE);
            $selected_num = sfGuardUserProfilePeer::doCount($c);
       }
	   if (!$selected_num)
       {
            $c->add(sfGuardUserProfilePeer::FIRST_NAME, mb_substr($author['first_name'], 0, 1).'%', Criteria::LIKE);
            $selected_num = sfGuardUserProfilePeer::doCount($c);
       }
       //Если фамилия и первая буква имени уже есть у двух людей в базе, тогда непонятно что
       if ($selected_num>1) return null;
       //Если есть один такой человек, его извлекаем
       if ($selected_num == 1)
       {
            $user = sfGuardUserProfilePeer::doSelectOne($c);
            //Надо убедиться, что он - это он
           if (!self::match_person($author, $user)) return null;
       }
       else $user = new sfGuardUserProfile();
       //Перезаписываем всё по новой для автора по переписке, если его данные полнее чем в базе
       $user->setLastName($author['last_name']);
       if (mb_strlen($author['first_name']) > mb_strlen ($user->getFirstName())) $user->setFirstName($author['first_name']);
       if (isset($author['middle_name']) &&
            mb_strlen($author['middle_name']) > mb_strlen ($user->getMiddleName()))
               $user->setMiddleName($author['middle_name']);
                              
       if ($user->isNew())
       {
            $guard_user = new sfGuardUser();
            $user->setsfGuardUser($guard_user);
            $guard_user->setUsername($user->generateUsername());
            $guard_user->setPassword(sfConfig::get('app_default_password'));
            $guard_user->setIsActive(false);
       }
       $user->save();
	   return $user;
	}
	
}