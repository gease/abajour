<?php

/**
 * review form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasereviewForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'       => new sfWidgetFormInputHidden(),
      'manuscript_id' => new sfWidgetFormInputHidden(),
      'contents'      => new sfWidgetFormTextarea(),
      'outcome'       => new sfWidgetFormInput(),
      'submitted'     => new sfWidgetFormDateTime(),
      'decision'      => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'user_id'       => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'manuscript_id' => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id', 'required' => false)),
      'contents'      => new sfValidatorString(array('required' => false)),
      'outcome'       => new sfValidatorInteger(),
      'submitted'     => new sfValidatorDateTime(),
      'decision'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('review[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'review';
  }


}
