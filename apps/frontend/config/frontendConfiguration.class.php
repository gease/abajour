<?php

class frontendConfiguration extends sfApplicationConfiguration
{
  public function configure()
  {
  	sfConfig::set('sf_upload_dir', '/var/www/abajour/uploads');
  }
}
