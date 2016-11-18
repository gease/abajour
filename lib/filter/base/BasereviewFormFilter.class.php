<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * review filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasereviewFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'contents'      => new sfWidgetFormFilterInput(),
      'outcome'       => new sfWidgetFormFilterInput(),
      'submitted'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'decision'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contents'      => new sfValidatorPass(array('required' => false)),
      'outcome'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'submitted'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'decision'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('review_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'review';
  }

  public function getFields()
  {
    return array(
      'user_id'       => 'ForeignKey',
      'manuscript_id' => 'ForeignKey',
      'contents'      => 'Text',
      'outcome'       => 'Number',
      'submitted'     => 'Date',
      'decision'      => 'Number',
    );
  }
}
