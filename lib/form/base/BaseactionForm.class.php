<?php

/**
 * action form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'manuscript_id' => new sfWidgetFormPropelChoice(array('model' => 'manuscript', 'add_empty' => false)),
      'status_before' => new sfWidgetFormInput(),
      'status_after'  => new sfWidgetFormInput(),
      'datetime'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'action', 'column' => 'id', 'required' => false)),
      'manuscript_id' => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id')),
      'status_before' => new sfValidatorInteger(),
      'status_after'  => new sfValidatorInteger(),
      'datetime'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('action[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'action';
  }


}
