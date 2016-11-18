<?php

/**
 * Issue form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseIssueForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'volume'         => new sfWidgetFormInputHidden(),
      'num'            => new sfWidgetFormInputHidden(),
      'status'         => new sfWidgetFormInput(),
      'published_date' => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'volume'         => new sfValidatorPropelChoice(array('model' => 'Issue', 'column' => 'volume', 'required' => false)),
      'num'            => new sfValidatorPropelChoice(array('model' => 'Issue', 'column' => 'num', 'required' => false)),
      'status'         => new sfValidatorInteger(),
      'published_date' => new sfValidatorDate(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('issue[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Issue';
  }


}
