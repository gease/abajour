<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * KeywordManuscriptRef filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseKeywordManuscriptRefFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('keyword_manuscript_ref_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KeywordManuscriptRef';
  }

  public function getFields()
  {
    return array(
      'keyword_id'    => 'ForeignKey',
      'manuscript_id' => 'ForeignKey',
    );
  }
}
