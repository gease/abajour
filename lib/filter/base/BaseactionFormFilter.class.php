<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * action filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseactionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'manuscript_id' => new sfWidgetFormPropelChoice(array('model' => 'manuscript', 'add_empty' => true)),
      'status_before' => new sfWidgetFormFilterInput(),
      'status_after'  => new sfWidgetFormFilterInput(),
      'datetime'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'manuscript_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'manuscript', 'column' => 'id')),
      'status_before' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'status_after'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'datetime'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('action_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'action';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'manuscript_id' => 'ForeignKey',
      'status_before' => 'Number',
      'status_after'  => 'Number',
      'datetime'      => 'Date',
    );
  }
}
