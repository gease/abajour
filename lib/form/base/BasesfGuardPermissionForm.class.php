<?php

require_once(dirname(__FILE__).DIRECTORY_SEPARATOR.'BaseFormPropel.class.php');

/**
 * sfGuardPermission form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: BasesfGuardPermissionForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class BasesfGuardPermissionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                             => new sfWidgetFormInputHidden(),
      'name'                           => new sfWidgetFormInput(),
      'description'                    => new sfWidgetFormTextarea(),
      'sf_guard_group_permission_list' => new sfWidgetFormPropelSelectMany(array('model' => 'sfGuardGroup')),
      'sf_guard_user_permission_list'  => new sfWidgetFormPropelSelectMany(array('model' => 'sfGuardUser')),
    ));

    $this->setValidators(array(
      'id'                             => new sfValidatorPropelChoice(array('model' => 'sfGuardPermission', 'column' => 'id', 'required' => false)),
      'name'                           => new sfValidatorString(array('max_length' => 255)),
      'description'                    => new sfValidatorString(array('required' => false)),
      'sf_guard_group_permission_list' => new sfValidatorPropelChoiceMany(array('model' => 'sfGuardGroup', 'required' => false)),
      'sf_guard_user_permission_list'  => new sfValidatorPropelChoiceMany(array('model' => 'sfGuardUser', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'sfGuardPermission', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('sf_guard_permission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardPermission';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['sf_guard_group_permission_list']))
    {
      $values = array();
      foreach ($this->object->getsfGuardGroupPermissions() as $obj)
      {
        $values[] = $obj->getGroupId();
      }

      $this->setDefault('sf_guard_group_permission_list', $values);
    }

    if (isset($this->widgetSchema['sf_guard_user_permission_list']))
    {
      $values = array();
      foreach ($this->object->getsfGuardUserPermissions() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('sf_guard_user_permission_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savesfGuardGroupPermissionList($con);
    $this->savesfGuardUserPermissionList($con);
  }

  public function savesfGuardGroupPermissionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['sf_guard_group_permission_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(sfGuardGroupPermissionPeer::PERMISSION_ID, $this->object->getPrimaryKey());
    sfGuardGroupPermissionPeer::doDelete($c, $con);

    $values = $this->getValue('sf_guard_group_permission_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new sfGuardGroupPermission();
        $obj->setPermissionId($this->object->getPrimaryKey());
        $obj->setGroupId($value);
        $obj->save();
      }
    }
  }

  public function savesfGuardUserPermissionList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['sf_guard_user_permission_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(sfGuardUserPermissionPeer::PERMISSION_ID, $this->object->getPrimaryKey());
    sfGuardUserPermissionPeer::doDelete($c, $con);

    $values = $this->getValue('sf_guard_user_permission_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new sfGuardUserPermission();
        $obj->setPermissionId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
