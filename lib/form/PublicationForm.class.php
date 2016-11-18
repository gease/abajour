<?php

/**
 * Publication form.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: PublicationForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class PublicationForm extends BasePublicationForm{
  public function configure()
  {
  	unset($this['year']);
  	$this->widgetSchema['new_status'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['new_status']->setDefault(manuscriptPeer::ACCEPTED_PUBL);
  	
    $this->validatorSchema['new_status'] = new sfValidatorChoice(array(
        'choices'=>array(manuscriptPeer::ACCEPTED_PUBL)
    ));
    $this->widgetSchema['number']->setLabel('Issue');
  	$this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback'=>array($this, 'checkOverlap'), 'arguments'=>null)));
  }
  
  /**
   * Check whether nothing is already published on given pages
   */
  public function checkOverlap ($validator, $values, $arguments)
  {
  	if ($values['last_page'] < $values['first_page'])
  	     throw new sfValidatorError($validator, 'Last page is less than first page');
  	$c = new Criteria();
  	$c->add(PublicationPeer::VOLUME, $values['volume']);
  	$c->add(PublicationPeer::NUMBER, $values['number']);
  	$papers = PublicationPeer::doSelect($c);
  	foreach ($papers as $paper)
  	{
  		if ($values['first_page'] < $paper->getFirstPage() && $values['last_page'] < $paper->getFirstPage()) continue;
  		if ($values['first_page'] > $paper->getLastPage() && $values['last_page'] > $paper->getLastPage()) continue;
  		throw new sfValidatorError($validator, 'Overlaps with another publication');
  	}
  	return $values;
  }
}
