<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * userManuscriptRef filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseuserManuscriptRefFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_corresponding_author' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'author_order'            => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'is_corresponding_author' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'author_order'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('user_manuscript_ref_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'userManuscriptRef';
  }

  public function getFields()
  {
    return array(
      'user_id'                 => 'ForeignKey',
      'manuscript_id'           => 'ForeignKey',
      'is_corresponding_author' => 'Boolean',
      'author_order'            => 'Number',
    );
  }
}
