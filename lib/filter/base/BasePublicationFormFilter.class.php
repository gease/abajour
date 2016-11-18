<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Publication filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePublicationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'volume'        => new sfWidgetFormFilterInput(),
      'number'        => new sfWidgetFormFilterInput(),
      'first_page'    => new sfWidgetFormFilterInput(),
      'last_page'     => new sfWidgetFormFilterInput(),
      'year'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'volume'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'number'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'first_page'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_page'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'year'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('publication_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Publication';
  }

  public function getFields()
  {
    return array(
      'manuscript_id' => 'ForeignKey',
      'volume'        => 'Number',
      'number'        => 'Number',
      'first_page'    => 'Number',
      'last_page'     => 'Number',
      'year'          => 'Number',
    );
  }
}
