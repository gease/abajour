<?php

class statsForm extends sfForm
{
	public function configure()
	{
		$years = range(sfConfig::get('app_journal_years_min'),sfConfig::get('app_journal_years_max'));
		$years = array_combine($years, $years);
		$this->setWidgets(array(
		  'date_range' => new sfWidgetFormDateRange(array(
		              'from_date' => new sfWidgetFormI18nDate(array('culture'=>sfContext::getInstance()->getI18N()->getCulture(), 'years' => $years)),
                       'to_date'   => new sfWidgetFormI18nDate(array('culture'=>sfContext::getInstance()->getI18N()->getCulture(), 'years' => $years)),
		               'template'  => sfContext::getInstance()->getI18n()->__('from').' %from_date%&nbsp;'.sfContext::getInstance()->getI18n()->__('to').' %to_date%'
		))));
		$this->setValidators(array(
		  'date_range'=> new sfValidatorDateRange(array(
                'from_date' => new sfValidatorDate(array('required'  => false)),
                'to_date'   => new sfValidatorDate(array('required'  => false)),
                'required'  => true
    ))));
    $this->widgetSchema->setNameFormat('stats[%s]');
	}
}
?>