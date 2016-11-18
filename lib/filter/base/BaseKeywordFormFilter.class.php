<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Keyword filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseKeywordFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'keyword'                     => new sfWidgetFormFilterInput(),
      'keyword_manuscript_ref_list' => new sfWidgetFormPropelChoice(array('model' => 'manuscript', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'keyword'                     => new sfValidatorPass(array('required' => false)),
      'keyword_manuscript_ref_list' => new sfValidatorPropelChoice(array('model' => 'manuscript', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('keyword_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addKeywordManuscriptRefListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(KeywordManuscriptRefPeer::KEYWORD_ID, KeywordPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Keyword';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'keyword'                     => 'Text',
      'keyword_manuscript_ref_list' => 'ManyKey',
    );
  }
}
