<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * GuardUser filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseGuardUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'last_name'          => new sfWidgetFormFilterInput(),
      'first_name'         => new sfWidgetFormFilterInput(),
      'middle_name'        => new sfWidgetFormFilterInput(),
      'birthday'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'gender'             => new sfWidgetFormFilterInput(),
      'country'            => new sfWidgetFormFilterInput(),
      'city_id'            => new sfWidgetFormPropelChoice(array('model' => 'city', 'add_empty' => true)),
      'institution'        => new sfWidgetFormFilterInput(),
      'address'            => new sfWidgetFormFilterInput(),
      'is_address_private' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'email'              => new sfWidgetFormFilterInput(),
      'qualification'      => new sfWidgetFormFilterInput(),
      'is_reviewer'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'username'           => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_login'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'is_active'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'last_name'          => new sfValidatorPass(array('required' => false)),
      'first_name'         => new sfValidatorPass(array('required' => false)),
      'middle_name'        => new sfValidatorPass(array('required' => false)),
      'birthday'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'gender'             => new sfValidatorPass(array('required' => false)),
      'country'            => new sfValidatorPass(array('required' => false)),
      'city_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'city', 'column' => 'id')),
      'institution'        => new sfValidatorPass(array('required' => false)),
      'address'            => new sfValidatorPass(array('required' => false)),
      'is_address_private' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'email'              => new sfValidatorPass(array('required' => false)),
      'qualification'      => new sfValidatorPass(array('required' => false)),
      'is_reviewer'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'username'           => new sfValidatorPass(array('required' => false)),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_login'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_active'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GuardUser';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'ForeignKey',
      'last_name'          => 'Text',
      'first_name'         => 'Text',
      'middle_name'        => 'Text',
      'birthday'           => 'Date',
      'gender'             => 'Text',
      'country'            => 'Text',
      'city_id'            => 'ForeignKey',
      'institution'        => 'Text',
      'address'            => 'Text',
      'is_address_private' => 'Boolean',
      'email'              => 'Text',
      'qualification'      => 'Text',
      'is_reviewer'        => 'Boolean',
      'username'           => 'Text',
      'created_at'         => 'Date',
      'last_login'         => 'Date',
      'is_active'          => 'Boolean',
      'is_super_admin'     => 'Boolean',
    );
  }
}
