<?php

/**
 * sfGuardUserProfile form.
 *
 * @package    CompTechnologies
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfGuardUserProfileForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class sfGuardUserProfileForm extends BasesfGuardUserProfileForm
{
  public function configure()
  {
//  	$years = range(1900, 2000 );
//  	$years = array_combine($years, $years);
//  	$this->widgetSchema['birthday']->setOption('years', $years);
	$this->widgetSchema['birthday'] = new myBirthdayWidget();
  	$this->widgetSchema['country'] = new sfWidgetFormI18nSelectCountry(array('culture' => sfContext::getInstance()->getI18N()->getCulture()));
  	$this->widgetSchema['gender'] = new sfWidgetFormSelect(array('choices'=>array(
  	     'M'=>sfContext::getInstance()->getI18N()->__('male'),
  	     'F'=>sfContext::getInstance()->getI18N()->__('female'))));
  	$this->widgetSchema['city_id']->addOption('order_by',array('Name','asc'));
  	
  	unset($this->widgetSchema['user_id']);
  	unset($this->validatorSchema['user_id']);
  	
  	unset($this->widgetSchema['is_reviewer']);
  	unset($this->validatorSchema['is_reviewer']);
  	
  	unset($this->widgetSchema['review_list']);
  	unset($this->validatorSchema['review_list']);
  	
  	unset($this->widgetSchema['user_manuscript_ref_list']);
    unset($this->validatorSchema['user_manuscript_ref_list']);
  	  	
  	$this->validatorSchema['gender'] = new sfValidatorChoice(array('choices'=>array('M', 'F')));
  	$this->validatorSchema->setPostValidator(new sfValidatorCallback(array('callback'=>array($this, 'checkDuplicate'), 'arguments'=>'' )));
  	
  	$this->widgetSchema->setLabels(array(
  	     'city_id'=>'City',
  	     'birthday'=>'Date of birth'
  	));
  	$this->widgetSchema['institution']->setAttribute('size','30');
  	$this->widgetSchema['address']->setAttribute('size','30');
  	$this->widgetSchema->setHelps(array(
  	     'country'   =>'Country you are working in',
  	     'city'      =>'If your city is not listed, leave the field blank and indicate your city in "address" field',
  	     'institution'=>'Commonly accepted name of your institution',
  	     'address'   =>'Full postal address for paper correspondence',
  	     'is_address_private'=>'Check this box if the address above is your private address',
  	     'email'     =>'Valid e-mail for further notifications and correspondence',
  	     'qualification'=>'Your titles and qualifications'
  	));
  }
  public function checkDuplicate ($validator, $values, $arguments)
  {
  	$c = new Criteria();
  	$c->add(sfGuardUserProfilePeer::FIRST_NAME, $values['first_name']);
  	$c->add(sfGuardUserProfilePeer::LAST_NAME, $values['last_name']);
  	$c->add(sfGuardUserProfilePeer::BIRTHDAY, $values['birthday']);
  	if ( sfGuardUserProfilePeer::doSelectOne($c) && $this->isNew ) throw new sfValidatorError($validator, 'Duplicate');
  	return $values;
  }
  
}
