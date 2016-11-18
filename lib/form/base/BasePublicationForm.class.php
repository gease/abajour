<?php

/**
 * Publication form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasePublicationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'manuscript_id' => new sfWidgetFormInputHidden(),
      'volume'        => new sfWidgetFormInput(),
      'number'        => new sfWidgetFormInput(),
      'first_page'    => new sfWidgetFormInput(),
      'last_page'     => new sfWidgetFormInput(),
      'year'          => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'manuscript_id' => new sfValidatorPropelChoice(array('model' => 'manuscript', 'column' => 'id', 'required' => false)),
      'volume'        => new sfValidatorInteger(),
      'number'        => new sfValidatorInteger(),
      'first_page'    => new sfValidatorInteger(),
      'last_page'     => new sfValidatorInteger(),
      'year'          => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('publication[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Publication';
  }


}
