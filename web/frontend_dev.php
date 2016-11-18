<?php
// this check prevents access to debug front conrollers that are deployed by accident to production servers.
// feel free to remove this, extend it or make something more sophisticated.
//if (!in_array(@$_SERVER['REMOTE_ADDR'], array('10.99.4.67','10.99.4.68','10.99.4.69','127.0.0.1','10.99.1.34','85.118.231.74','::1')))
//{
  //die('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
//}

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
