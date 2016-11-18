<?php

/**
 * KeywordManuscriptRef form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BaseKeywordManuscriptRefForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'keyword_id'    => new sfWidgetFormInputHidden(),
      'manuscript_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'keyword_id'    => new sfValidatorPropelChoice(array('model' => 'Keyword', 'column' => 'id', 'required' => false)),
      'manuscript_id' => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('keyword_manuscript_ref[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'KeywordManuscriptRef';
  }


}
