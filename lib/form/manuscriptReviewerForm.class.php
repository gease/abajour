<?php

/**
 * manuscriptReviewer form.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 */
class manuscriptReviewerForm extends sfFormPropel
{
  public function configure()
  {
  	$c = new Criteria();
  	$c->add(GuardUserPeer::IS_REVIEWER, true);
  	$this->widgetSchema['reviewer'] = new sfWidgetFormPropelSelect(array(
  		'model'=>'GuardUser',
  		'criteria'=>$c,
  		'order_by'=>array('LastName', 'asc')
  	));
  	$this->widgetSchema['id'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['new_status'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['new_status']->setDefault(manuscriptPeer::UNDER_REVIEW);
  	$this->validatorSchema['reviewer'] = new sfValidatorPropelChoice(array(
  		'model'=>'GuardUser',
  		'criteria'=>$c
  	));
  	$this->validatorSchema['id'] = new sfValidatorPropelChoice(array(
  		'model'=>'manuscript',
  		'required'=>true
  	));
  	$this->validatorSchema['new_status'] = new sfValidatorChoice(array(
  		'choices'=>array(manuscriptPeer::UNDER_REVIEW)
  	));
  	$this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback'=>array($this, 'checkReview'), 'arguments'=>null)));
  	
  	$this->widgetSchema->setNameFormat('manuscript_reviewer[%s]');
  }
  
  public function checkReview ($validator, $values, $arguments)
  {
    $c = new Criteria();
    $c->add(reviewPeer::USER_ID, $values['reviewer']);
    $c->add(reviewPeer::MANUSCRIPT_ID, $values['id']);
    $r = reviewPeer::doSelectOne($c);
    if ( $r ) throw new sfValidatorError($validator, 'Wrong reviewer/manuscript combination');
    return $values;
  }
  
  public function getModelName()
  {
	return 'manuscript';
  }
}