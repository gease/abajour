<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'BaseFormPropel.class.php');

/**
 * sfGuardUserGroup form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: BasesfGuardUserGroupForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class BasesfGuardUserGroupForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'  => new sfWidgetFormInputHidden(),
      'group_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'user_id'  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'group_id' => new sfValidatorPropelChoice(array('model' => 'sfGuardGroup', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserGroup';
  }


}
