<?php

/**
 * sfGuardUserProfile form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasesfGuardUserProfileForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'                  => new sfWidgetFormInputHidden(),
      'last_name'                => new sfWidgetFormInput(),
      'first_name'               => new sfWidgetFormInput(),
      'middle_name'              => new sfWidgetFormInput(),
      'birthday'                 => new sfWidgetFormDate(),
      'gender'                   => new sfWidgetFormInput(),
      'country'                  => new sfWidgetFormInput(),
      'city_id'                  => new sfWidgetFormPropelChoice(array('model' => 'city', 'add_empty' => true)),
      'institution'              => new sfWidgetFormInput(),
      'address'                  => new sfWidgetFormInput(),
      'is_address_private'       => new sfWidgetFormInputCheckbox(),
      'email'                    => new sfWidgetFormInput(),
      'phone_home'               => new sfWidgetFormInput(),
      'phone_work'               => new sfWidgetFormInput(),
      'qualification'            => new sfWidgetFormInput(),
      'is_reviewer'              => new sfWidgetFormInputCheckbox(),
      'review_list'              => new sfWidgetFormPropelChoiceMany(array('model' => 'manuscript')),
      'user_manuscript_ref_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'manuscript')),
    ));

    $this->setValidators(array(
      'user_id'                  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id', 'required' => false)),
      'last_name'                => new sfValidatorString(array('max_length' => 20)),
      'first_name'               => new sfValidatorString(array('max_length' => 20)),
      'middle_name'              => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'birthday'                 => new sfValidatorDate(array('required' => false)),
      'gender'                   => new sfValidatorString(array('max_length' => 1)),
      'country'                  => new sfValidatorString(array('max_length' => 2)),
      'city_id'                  => new sfValidatorPropelChoice(array('model' => 'city', 'column' => 'id', 'required' => false)),
      'institution'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'                  => new sfValidatorString(array('max_length' => 255)),
      'is_address_private'       => new sfValidatorBoolean(),
      'email'                    => new sfValidatorString(array('max_length' => 100)),
      'phone_home'               => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'phone_work'               => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'qualification'            => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'is_reviewer'              => new sfValidatorBoolean(),
      'review_list'              => new sfValidatorPropelChoiceMany(array('model' => 'manuscript', 'required' => false)),
      'user_manuscript_ref_list' => new sfValidatorPropelChoiceMany(array('model' => 'manuscript', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['review_list']))
    {
      $values = array();
      foreach ($this->object->getreviews() as $obj)
      {
        $values[] = $obj->getManuscriptId();
      }

      $this->setDefault('review_list', $values);
    }

    if (isset($this->widgetSchema['user_manuscript_ref_list']))
    {
      $values = array();
      foreach ($this->object->getuserManuscriptRefs() as $obj)
      {
        $values[] = $obj->getManuscriptId();
      }

      $this->setDefault('user_manuscript_ref_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->savereviewList($con);
    $this->saveuserManuscriptRefList($con);
  }

  public function savereviewList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['review_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(reviewPeer::USER_ID, $this->object->getPrimaryKey());
    reviewPeer::doDelete($c, $con);

    $values = $this->getValue('review_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new review();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setManuscriptId($value);
        $obj->save();
      }
    }
  }

  public function saveuserManuscriptRefList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['user_manuscript_ref_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(userManuscriptRefPeer::USER_ID, $this->object->getPrimaryKey());
    userManuscriptRefPeer::doDelete($c, $con);

    $values = $this->getValue('user_manuscript_ref_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new userManuscriptRef();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setManuscriptId($value);
        $obj->save();
      }
    }
  }

}
