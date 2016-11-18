<?php
class manuscriptChangeStatusForm extends sfFormPropel
{
	public function configure()
	{
		$choices_keys = $this->options['choices'];
		$choices = array_combine($choices_keys, array_map(array('manuscriptPeer', 'statusString'), $choices_keys));
		$choices = array_map(array(sfContext::getInstance()->getI18N(),'__'), $choices);
		$this->setWidgets(array(
			'new_status' => new sfWidgetFormChoice(array('choices'=>$choices)),
			'id'         => new sfWidgetFormInputHidden()
		));
		$this->setValidators(array(
			'new_status' => new sfValidatorChoice(array('choices'=>$choices_keys)),
			'id'         => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id', 'required' => true)),
		));
		$this->widgetSchema->setNameFormat('manuscript_change_status[%s]');
	}
	public function getModelName()
	{
		return 'manuscript';
	}
}

?>