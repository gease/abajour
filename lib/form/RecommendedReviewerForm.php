<?php

class RecommendedReviewerForm extends sfForm
{
	public function configure()
	{
		$this->setWidgets(array(
		  'name'          => new sfWidgetFormInput(),
		  'institution'   => new sfWidgetFormInput(),
		  'email'         => new sfWidgetFormInput()
		));
		$this->setValidators(array(
		  'name'          => new sfValidatorString(),
		  'institution'   => new sfValidatorString(),
		  'email'         => new sfValidatorEmail()
		));
		$this->widgetSchema->setNameFormat(empty($this->options['name'])? '%s': $this->options['name'].'[%s]');
	}
}