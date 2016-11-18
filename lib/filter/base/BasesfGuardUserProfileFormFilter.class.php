<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * sfGuardUserProfile filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasesfGuardUserProfileFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'last_name'                => new sfWidgetFormFilterInput(),
      'first_name'               => new sfWidgetFormFilterInput(),
      'middle_name'              => new sfWidgetFormFilterInput(),
      'birthday'                 => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'gender'                   => new sfWidgetFormFilterInput(),
      'country'                  => new sfWidgetFormFilterInput(),
      'city_id'                  => new sfWidgetFormPropelChoice(array('model' => 'city', 'add_empty' => true)),
      'institution'              => new sfWidgetFormFilterInput(),
      'address'                  => new sfWidgetFormFilterInput(),
      'is_address_private'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'email'                    => new sfWidgetFormFilterInput(),
      'phone_home'               => new sfWidgetFormFilterInput(),
      'phone_work'               => new sfWidgetFormFilterInput(),
      'qualification'            => new sfWidgetFormFilterInput(),
      'is_reviewer'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'review_list'              => new sfWidgetFormPropelChoice(array('model' => 'manuscript', 'add_empty' => true)),
      'user_manuscript_ref_list' => new sfWidgetFormPropelChoice(array('model' => 'manuscript', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'last_name'                => new sfValidatorPass(array('required' => false)),
      'first_name'               => new sfValidatorPass(array('required' => false)),
      'middle_name'              => new sfValidatorPass(array('required' => false)),
      'birthday'                 => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'gender'                   => new sfValidatorPass(array('required' => false)),
      'country'                  => new sfValidatorPass(array('required' => false)),
      'city_id'                  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'city', 'column' => 'id')),
      'institution'              => new sfValidatorPass(array('required' => false)),
      'address'                  => new sfValidatorPass(array('required' => false)),
      'is_address_private'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'email'                    => new sfValidatorPass(array('required' => false)),
      'phone_home'               => new sfValidatorPass(array('required' => false)),
      'phone_work'               => new sfValidatorPass(array('required' => false)),
      'qualification'            => new sfValidatorPass(array('required' => false)),
      'is_reviewer'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'review_list'              => new sfValidatorPropelChoice(array('model' => 'manuscript', 'required' => false)),
      'user_manuscript_ref_list' => new sfValidatorPropelChoice(array('model' => 'manuscript', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_profile_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addreviewListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(reviewPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(reviewPeer::MANUSCRIPT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(reviewPeer::MANUSCRIPT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function adduserManuscriptRefListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(userManuscriptRefPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(userManuscriptRefPeer::MANUSCRIPT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(userManuscriptRefPeer::MANUSCRIPT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'sfGuardUserProfile';
  }

  public function getFields()
  {
    return array(
      'user_id'                  => 'ForeignKey',
      'last_name'                => 'Text',
      'first_name'               => 'Text',
      'middle_name'              => 'Text',
      'birthday'                 => 'Date',
      'gender'                   => 'Text',
      'country'                  => 'Text',
      'city_id'                  => 'ForeignKey',
      'institution'              => 'Text',
      'address'                  => 'Text',
      'is_address_private'       => 'Boolean',
      'email'                    => 'Text',
      'phone_home'               => 'Text',
      'phone_work'               => 'Text',
      'qualification'            => 'Text',
      'is_reviewer'              => 'Boolean',
      'review_list'              => 'ManyKey',
      'user_manuscript_ref_list' => 'ManyKey',
    );
  }
}
