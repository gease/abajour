<?php

/**
 * Keyword form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseKeywordForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                          => new sfWidgetFormInputHidden(),
      'keyword'                     => new sfWidgetFormInput(),
      'keyword_manuscript_ref_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'manuscript')),
    ));

    $this->setValidators(array(
      'id'                          => new sfValidatorPropelChoice(array('model' => 'Keyword', 'column' => 'id', 'required' => false)),
      'keyword'                     => new sfValidatorString(array('max_length' => 100)),
      'keyword_manuscript_ref_list' => new sfValidatorPropelChoiceMany(array('model' => 'manuscript', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('keyword[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Keyword';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['keyword_manuscript_ref_list']))
    {
      $values = array();
      foreach ($this->object->getKeywordManuscriptRefs() as $obj)
      {
        $values[] = $obj->getManuscriptId();
      }

      $this->setDefault('keyword_manuscript_ref_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveKeywordManuscriptRefList($con);
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
    $c->add(KeywordManuscriptRefPeer::KEYWORD_ID, $this->object->getPrimaryKey());
    KeywordManuscriptRefPeer::doDelete($c, $con);

    $values = $this->getValue('keyword_manuscript_ref_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new KeywordManuscriptRef();
        $obj->setKeywordId($this->object->getPrimaryKey());
        $obj->setManuscriptId($value);
        $obj->save();
      }
    }
  }

}
