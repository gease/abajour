<?php

/**
 * manuscript form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasemanuscriptForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'title'                       => new sfWidgetFormInput(),
      'status'                      => new sfWidgetFormInput(),
      'pages'                       => new sfWidgetFormInput(),
      'city_id'                     => new sfWidgetFormPropelChoice(array('model' => 'city', 'add_empty' => true)),
      'comment'                     => new sfWidgetFormTextarea(),
      'annotation'                  => new sfWidgetFormTextarea(),
      'letter'                      => new sfWidgetFormTextarea(),
      'keywords_freetext'           => new sfWidgetFormInput(),
      'reviewers_request'           => new sfWidgetFormInput(),
      'keyword_manuscript_ref_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Keyword')),
      'review_list'                 => new sfWidgetFormPropelChoiceMany(array('model' => 'sfGuardUserProfile')),
      'user_manuscript_ref_list'    => new sfWidgetFormPropelChoiceMany(array('model' => 'sfGuardUserProfile')),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id', 'required' => false)),
      'title'                       => new sfValidatorString(array('max_length' => 1000)),
      'status'                      => new sfValidatorInteger(),
      'pages'                       => new sfValidatorInteger(array('required' => false)),
      'city_id'                     => new sfValidatorPropelChoice(array('model' => 'city', 'column' => 'id', 'required' => false)),
      'comment'                     => new sfValidatorString(array('required' => false)),
      'annotation'                  => new sfValidatorString(),
      'letter'                      => new sfValidatorString(array('required' => false)),
      'keywords_freetext'           => new sfValidatorString(array('max_length' => 500)),
      'reviewers_request'           => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'keyword_manuscript_ref_list' => new sfValidatorPropelChoiceMany(array('model' => 'Keyword', 'required' => false)),
      'review_list'                 => new sfValidatorPropelChoiceMany(array('model' => 'sfGuardUserProfile', 'required' => false)),
      'user_manuscript_ref_list'    => new sfValidatorPropelChoiceMany(array('model' => 'sfGuardUserProfile', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('manuscript[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'manuscript';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['keyword_manuscript_ref_list']))
    {
      $values = array();
      foreach ($this->object->getKeywordManuscriptRefs() as $obj)
      {
        $values[] = $obj->getKeywordId();
      }

      $this->setDefault('keyword_manuscript_ref_list', $values);
    }

    if (isset($this->widgetSchema['review_list']))
    {
      $values = array();
      foreach ($this->object->getreviews() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('review_list', $values);
    }

    if (isset($this->widgetSchema['user_manuscript_ref_list']))
    {
      $values = array();
      foreach ($this->object->getuserManuscriptRefs() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('user_manuscript_ref_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveKeywordManuscriptRefList($con);
    $this->savereviewList($con);
    $this->saveuserManuscriptRefList($con);
  }

  public function saveKeywordManuscriptRefList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['keyword_manuscript_ref_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(KeywordManuscriptRefPeer::MANUSCRIPT_ID, $this->object->getPrimaryKey());
    KeywordManuscriptRefPeer::doDelete($c, $con);

    $values = $this->getValue('keyword_manuscript_ref_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new KeywordManuscriptRef();
        $obj->setManuscriptId($this->object->getPrimaryKey());
        $obj->setKeywordId($value);
        $obj->save();
      }
    }
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
    $c->add(reviewPeer::MANUSCRIPT_ID, $this->object->getPrimaryKey());
    reviewPeer::doDelete($c, $con);

    $values = $this->getValue('review_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new review();
        $obj->setManuscriptId($this->object->getPrimaryKey());
        $obj->setUserId($value);
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
    $c->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->object->getPrimaryKey());
    userManuscriptRefPeer::doDelete($c, $con);

    $values = $this->getValue('user_manuscript_ref_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new userManuscriptRef();
        $obj->setManuscriptId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
