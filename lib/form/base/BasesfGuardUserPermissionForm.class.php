<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'BaseFormPropel.class.php');

/**
 * sfGuardUserPermission form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: BasesfGuardUserPermissionForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class BasesfGuardUserPermissionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'       => new sfWidgetFormInputHidden(),
      'permission_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id'       => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'permission_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardPermission', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserPermission';
  }


}
