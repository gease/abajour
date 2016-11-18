<?php

class paperReplyForm extends BaseFormPropel
{
	public function configure()
	{
		$this->setWidgets(array(
		  'id'                => new sfWidgetFormInputHidden(),
		  'file'              => new sfWidgetFormInputFile(),
		  'change_reviewer'   => new sfWidgetFormInputCheckbox()
		));
		
		$this->setValidators(array(
		  'id'                => new sfValidatorPropelChoice(array('model'=>'manuscript')),
		  'file'              => new sfValidatorFile(array('mime_types'=>sfConfig::get('app_file_mime'), 'max_size'=>sfConfig::get('app_file_size'))),
		  'change_reviewer'   => new sfValidatorBoolean()
		));
		if (sfConfig::get('app_file_extra_archive', false))
		{
			$this->widgetSchema['archive_file'] = new sfWidgetFormInputFile();
		    $this->validatorSchema['archive_file'] = new myValidatorFile(array('mime_types'=>sfConfig::get('app_file_archive_mime'),
                                                                'max_size'=>sfConfig::get('app_file_size'), 'required'=>false ));
		    $this->widgetSchema->setLabel('archive_file', 'Zipped extra files');
		}
		$this->widgetSchema->setNameFormat('paper_reply[%s]');
		
	   $formatter = new myWidgetFormSchemaFormatterTable($this->getWidgetSchema(), $this->getValidatorSchema());
       $this->getWidgetSchema()->addFormFormatter('my_table', $formatter);
       $this->getWidgetSchema()->setFormFormatterName('my_table');
	}
	
	public function getModelName()
	{
		return 'manuscript';
	}
}