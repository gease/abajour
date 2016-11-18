<?php
var_dump('hello');
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');
var_dump('world');
$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);
var_dump($configuration);
sfContext::createInstance($configuration)->dispatch();
