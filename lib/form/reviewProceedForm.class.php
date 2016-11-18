<?php

class reviewProceedForm extends sfFormPropel
{
	public function configure()
	{
		$choices = array(
		  sfContext::getInstance()->getI18N()->__('Proceed to review form'),
		  sfContext::getInstance()->getI18N()->__('Reject reviewing')
		);
		$this->setWidget('choice', new sfWidgetFormChoice(array('choices'=>$choices, 'expanded'=>true)));
		$this->setWidget('id', new sfWidgetFormInputHidden());
		$this->setValidator('choice', new sfValidatorChoice(array('choices'=>array_keys($choices))));
		$this->setValidator('id', new sfValidatorPropelChoice(array('model'=>'manuscript')));
		$this->widgetSchema->setNameFormat('proceed[%s]');
		$this->widgetSchema['choice']->setLabel('&nbsp;');
	}
	
	public function getModelName()
	{
		return 'manuscript';
	}
}
?>