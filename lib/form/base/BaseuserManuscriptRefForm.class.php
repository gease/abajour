<?php

/**
 * userManuscriptRef form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseuserManuscriptRefForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                 => new sfWidgetFormInputHidden(),
      'manuscript_id'           => new sfWidgetFormInputHidden(),
      'is_corresponding_author' => new sfWidgetFormInputCheckbox(),
      'author_order'            => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'user_id'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'manuscript_id'           => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id', 'required' => false)),
      'is_corresponding_author' => new sfValidatorBoolean(),
      'author_order'            => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('user_manuscript_ref[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'userManuscriptRef';
  }


}
