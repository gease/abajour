<?php
class myBirthdayWidget extends sfWidgetFormI18nDate
{
	public function __construct ($options = array(), $attributes = array())
	{
		$years = range(sfConfig::get('app_birthday_min', 1900), sfConfig::get('app_birthday_max', 2000) );
  		$years = array_combine($years, $years);
  		$options['years'] = $years;
  		$options['culture'] = sfContext::getInstance()->getI18N()->getCulture();
  		parent::__construct($options, $attributes);
  		$this->setLabel('Date of birth');
	}
}
?>