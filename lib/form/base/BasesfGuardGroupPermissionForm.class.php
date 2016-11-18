<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'BaseFormPropel.class.php');

/**
 * sfGuardGroupPermission form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: BasesfGuardGroupPermissionForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class BasesfGuardGroupPermissionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'group_id'      => new sfWidgetFormInputHidden(),
      'permission_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'group_id'      => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'column' => 'id', 'required' => false)),
      'permission_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardPermission', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroupPermission';
  }


}
