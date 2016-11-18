<?php

/**
 * city form base class.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 16976 2009-04-04 12:47:44Z fabien $
 */
class BasecityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'name'      => new sfWidgetFormInput(),
      'region_id' => new sfWidgetFormPropelChoice(array('model' => 'Region', 'add_empty' => true)),
      'country'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'city', 'column' => 'id', 'required' => false)),
      'name'      => new sfValidatorString(array('max_length' => 30)),
      'region_id' => new sfValidatorPropelChoice(array('model' => 'Region', 'column' => 'id', 'required' => false)),
      'country'   => new sfValidatorString(array('max_length' => 2)),
    ));

    $this->widgetSchema->setNameFormat('city[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'city';
  }


}
