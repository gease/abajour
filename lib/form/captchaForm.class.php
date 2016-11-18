<?php
/**
 * Form that has a single captcha field.
 *
 * Форма, содержащая единственное поле - капчу
 * @package    magazine
 * @subpackage lib.forms
 * @author     Vadim Valuev
 * @version    SVN: $Id: captchaForm.class.php 170 2009-11-08 20:38:51Z я $
 */

class captchaForm extends sfForm
{
	public function configure()
	{
    $this->setWidgets(array(
      'captcha'       => new sfWidgetFormInput(),
    ));
     $this->widgetSchema->setLabels(array(
      'captcha'       => 'Security code',
    ));
    $this->setValidators(array(
      'captcha'    => new sfValidatorSfCryptoCaptcha(array('required' => true, 'trim' => true),
                                                     array('wrong_captcha' => 'The code you copied is not valid.',
                                                           'required' => 'You did not copy any code. Please copy the code.')),
    ));
    $this->widgetSchema->setHelp('captcha', 'Please type in the security code from the image.If you cannot read the code, reload the image with the help of adjacent button.');
    $this->widgetSchema->setNameFormat('captcha[%s]');
    $this->widgetSchema->setFormFormatterName('table');
    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('captchaForm');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  	}
}
?>