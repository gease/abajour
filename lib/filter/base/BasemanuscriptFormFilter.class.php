<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * manuscript filter form base class.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasemanuscriptFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'                       => new sfWidgetFormFilterInput(),
      'status'                      => new sfWidgetFormFilterInput(),
      'pages'                       => new sfWidgetFormFilterInput(),
      'city_id'                     => new sfWidgetFormPropelChoice(array('model' => 'city', 'add_empty' => true)),
      'comment'                     => new sfWidgetFormFilterInput(),
      'annotation'                  => new sfWidgetFormFilterInput(),
      'letter'                      => new sfWidgetFormFilterInput(),
      'keywords_freetext'           => new sfWidgetFormFilterInput(),
      'reviewers_request'           => new sfWidgetFormFilterInput(),
      'keyword_manuscript_ref_list' => new sfWidgetFormPropelChoice(array('model' => 'Keyword', 'add_empty' => true)),
      'review_list'                 => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true)),
      'user_manuscript_ref_list'    => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUserProfile', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'title'                       => new sfValidatorPass(array('required' => false)),
      'status'                      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pages'                       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'city_id'                     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'city', 'column' => 'id')),
      'comment'                     => new sfValidatorPass(array('required' => false)),
      'annotation'                  => new sfValidatorPass(array('required' => false)),
      'letter'                      => new sfValidatorPass(array('required' => false)),
      'keywords_freetext'           => new sfValidatorPass(array('required' => false)),
      'reviewers_request'           => new sfValidatorPass(array('required' => false)),
      'keyword_manuscript_ref_list' => new sfValidatorPropelChoice(array('model' => 'Keyword', 'required' => false)),
      'review_list'                 => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'required' => false)),
      'user_manuscript_ref_list'    => new sfValidatorPropelChoice(array('model' => 'sfGuardUserProfile', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('manuscript_filters[%s]');

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

    $criteria->addJoin(KeywordManuscriptRefPeer::MANUSCRIPT_ID, manuscriptPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(KeywordManuscriptRefPeer::KEYWORD_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(KeywordManuscriptRefPeer::KEYWORD_ID, $value));
    }

    $criteria->add($criterion);
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

    $criteria->addJoin(reviewPeer::MANUSCRIPT_ID, manuscriptPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(reviewPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(reviewPeer::USER_ID, $value));
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

    $criteria->addJoin(userManuscriptRefPeer::MANUSCRIPT_ID, manuscriptPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(userManuscriptRefPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(userManuscriptRefPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'manuscript';
  }

  public function getFields()
  {
    return array(
      'id'                          => 'Number',
      'title'                       => 'Text',
      'status'                      => 'Number',
      'pages'                       => 'Number',
      'city_id'                     => 'ForeignKey',
      'comment'                     => 'Text',
      'annotation'                  => 'Text',
      'letter'                      => 'Text',
      'keywords_freetext'           => 'Text',
      'reviewers_request'           => 'Text',
      'keyword_manuscript_ref_list' => 'ManyKey',
      'review_list'                 => 'ManyKey',
      'user_manuscript_ref_list'    => 'ManyKey',
    );
  }
}
