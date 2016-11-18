  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);
  	$infile = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR. 'raw'.DIRECTORY_SEPARATOR.'Портфель.txt';
    $outfile = sfConfig::get('sf_data_dir').DIRECTORY_SEPARATOR. 'sql'.DIRECTORY_SEPARATOR.'import.sql';
	$fin = fopen($infile, 'r');
	//$fout = fopen($outfile, 'w');
	while ($string=fgets($fin))
	{
		$fields = split(';', $string);
		//echo $string;
		$l_name = trim($fields[7], '"');
		$pat = '/^[\w,\s]+$/';
		if (preg_match($pat, $l_name))
		{
			$user = new sfGuardUser();
			$user->setUsername($l_name);
			$user->setPassword('111');
			$c = new Criteria();
			$c->add(sfGuardUserPeer::USERNAME, $l_name);
			$this->logSection('port', $user->getUsername());
			if (!sfGuardUserPeer::doSelectOne($c)) $user->save();
		}
				
		//$outstring = "insert into sf_guard_user (username) value ('".$l_name."');\n";
		//fwrite($fout, $outstring);
	}
	fclose($fin);
	//fclose($fout);
  }