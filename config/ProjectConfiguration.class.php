<?php

# FROZEN_SF_LIB_DIR: C:\php5\PEAR\symfony

require_once dirname(__FILE__).'/../lib/symfony/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
  	  $this->enableAllPluginsExcept(array('sfDoctrinePlugin', 'sfCompat10Plugin'));
  sfConfig::set('sf_vendor_dir', sfConfig::get('sf_lib_dir').DIRECTORY_SEPARATOR.'vendor');
  }
}
