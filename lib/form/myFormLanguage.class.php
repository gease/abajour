<?php
class myFormLanguage extends sfFormLanguage
{
  public function configure()
  {
    $this->setValidators(array(
      'language' => new sfValidatorI18nChoiceLanguage(array('culture' => sfContext::getInstance()->getUser()->getCulture(), 'languages' => $this->options['languages'])),
    ));

    $this->setWidgets(array(
      'language' => new sfWidgetFormI18nSelectLanguage(array('culture' => sfContext::getInstance()->getUser()->getCulture(), 'languages' => $this->options['languages'])),
    ));
    $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('my_form_language');
  }
}