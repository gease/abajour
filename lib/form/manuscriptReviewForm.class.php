<?php

/**
 *
 * Admin form to select reviewers with pending reviews for a paper
 * and proceed to submitting review on behalf of selected one
 *
 */

class manuscriptReviewForm extends sfFormPropel
{
  	
  public function configure()
  {
  	
  	$c = new Criteria();
  	$c->add(sfGuardUserProfilePeer::IS_REVIEWER, true);
  	$c->addJoin(sfGuardUserProfilePeer::USER_ID, reviewPeer::USER_ID);
  	$c->add(reviewPeer::MANUSCRIPT_ID, $this->getObject()->getId());
  	$c->add(reviewPeer::OUTCOME, reviewPeer::UNREVIEWED);
  	$c->addOr(reviewPeer::OUTCOME, reviewPeer::REVISE);
  	$c->addOr(reviewPeer::OUTCOME, reviewPeer::ACCEPT_COMMENT);
  	$c_valid = new Criteria();
    $c_valid->add(sfGuardUserProfilePeer::IS_REVIEWER, true);
  	
  	$this->widgetSchema['reviewer'] = new sfWidgetFormPropelChoice(array(
  	 'model'    => 'sfGuardUserProfile',
  	 'criteria' => $c
  	));
  	
  	$this->widgetSchema['manuscript'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['manuscript']->setDefault($this->getObject()->getId());
  	
  	$this->validatorSchema['reviewer'] = new sfValidatorPropelChoice(array(
  	 'model'    => 'sfGuardUserProfile',
     'criteria' => $c_valid
  	));
  	$this->validatorSchema['manuscript'] = new sfValidatorPropelChoice(array(
  	 'model'     => 'manuscript'
  	));
  	
    $this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback'=>array($this, 'checkReview'), 'arguments'=>null)));
  	
  	$this->widgetSchema->setNameFormat('manuscript_review[%s]');
  }
  
  public function checkReview ($validator, $values, $arguments)
  {
  	$c = new Criteria();
  	$c->add(reviewPeer::USER_ID, $values['reviewer']);
  	$c->add(reviewPeer::MANUSCRIPT_ID, $values['manuscript']);
  	if ($this->options['status'] == manuscriptPeer::UNDER_REVIEW)
  	     $c->add(reviewPeer::OUTCOME, reviewPeer::UNREVIEWED);
    else $c->add(reviewPeer::DECISION, null);
  	$r = reviewPeer::doSelectOne($c);
  	if ( !$r ) throw new sfValidatorError($validator, 'Wrong reviewer/manuscript combination');
  	return $values;
  }
  
	
  public function getModelName()
  {
    return 'manuscript';
  }

  public function __construct (BaseObject $object = null, $options = array(), $CSRFSecret = null)
  {
    if (!isset($options['status'])) $options['status'] = manuscriptPeer::UNDER_REVIEW;
    parent::__construct($object, $options, $CSRFSecret);
  }
}