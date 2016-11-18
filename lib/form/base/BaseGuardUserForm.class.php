<?php

/**
 * GuardUser form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseGuardUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'last_name'          => new sfWidgetFormInput(),
      'first_name'         => new sfWidgetFormInput(),
      'middle_name'        => new sfWidgetFormInput(),
      'birthday'           => new sfWidgetFormDate(),
      'gender'             => new sfWidgetFormInput(),
      'country'            => new sfWidgetFormInput(),
      'city_id'            => new sfWidgetFormPropelChoice(array('model' => 'city', 'add_empty' => true)),
      'institution'        => new sfWidgetFormInput(),
      'address'            => new sfWidgetFormInput(),
      'is_address_private' => new sfWidgetFormInputCheckbox(),
      'email'              => new sfWidgetFormInput(),
      'qualification'      => new sfWidgetFormInput(),
      'is_reviewer'        => new sfWidgetFormInputCheckbox(),
      'username'           => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
      'last_login'         => new sfWidgetFormDateTime(),
      'is_active'          => new sfWidgetFormInputCheckbox(),
      'is_super_admin'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'column' => 'user_id', 'required' => false)),
      'last_name'          => new sfValidatorString(array('max_length' => 20)),
      'first_name'         => new sfValidatorString(array('max_length' => 20)),
      'middle_name'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'birthday'           => new sfValidatorDate(array('required' => false)),
      'gender'             => new sfValidatorString(array('max_length' => 1)),
      'country'            => new sfValidatorString(array('max_length' => 2)),
      'city_id'            => new sfValidatorPropelChoice(array('model' => 'city', 'column' => 'id', 'required' => false)),
      'institution'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'            => new sfValidatorString(array('max_length' => 255)),
      'is_address_private' => new sfValidatorBoolean(),
      'email'              => new sfValidatorString(array('max_length' => 100)),
      'qualification'      => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'is_reviewer'        => new sfValidatorBoolean(),
      'username'           => new sfValidatorString(array('max_length' => 128)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'last_login'         => new sfValidatorDateTime(array('required' => false)),
      'is_active'          => new sfValidatorBoolean(),
      'is_super_admin'     => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'GuardUser', 'column' => array('username')))
    );

    $this->widgetSchema->setNameFormat('guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GuardUser';
  }


}
