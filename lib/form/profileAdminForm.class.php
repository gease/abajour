<?php

class profileAdminForm extends BasesfGuardUserProfileForm
{
    public function configure()
    {
    	unset($this['review_list'], $this['user_manuscript_ref_list']);
    	$this->widgetSchema['birthday'] = new myBirthdayWidget();
    	$this->widgetSchema['country'] = new sfWidgetFormI18nSelectCountry(array('culture' => sfContext::getInstance()->getI18N()->getCulture()));
    	$this->widgetSchema['gender'] = new sfWidgetFormSelect(array('choices'=>array(
             'M'=>sfContext::getInstance()->getI18N()->__('male'),
             'F'=>sfContext::getInstance()->getI18N()->__('female'))
    	));
    	$this->widgetSchema->setLabel('city_id', "City");
    	$c = new Criteria();
    	$c->addAscendingOrderByColumn(cityPeer::NAME);
    	$this->widgetSchema['city_id']->addOption('criteria', $c);
    	$this->validatorSchema['gender'] = new sfValidatorChoice(array('choices'=>array('M', 'F')));
    	$this->validatorSchema['email']  = new sfValidatorEmail();
        $this->validatorSchema['last_name'] = new sfValidatorRegex(array('pattern'=>'/^([\x41-\x5a]|[\x61-\x7a]|[\xe0-\x{17e}]|[\x{410}-\x{44f}]|[\040\'-])+$/u'));
    	$this->validatorSchema['first_name'] = new sfValidatorRegex(array('pattern'=>'/^([\x41-\x5a]|[\x61-\x7a]|[\xe0-\x{17e}]|[\x{410}-\x{44f}]|[\040\'-])+$/u'));
    }
    
    protected function doSave ($con = null)
    {
    	if ($this->isNew())
    	{
    		$guard_user = new sfGuardUser();
    		$this->updateObject();
    		$this->getObject()->setsfGuardUser($guard_user);
    		$guard_user->setIsActive(false);
    		$guard_user->setUsername($this->getObject()->generateUsername());
    		$guard_user->setPassword(sfConfig::get('app_default_password'));
    		parent::doSave();
    	}
    	else
    	{
    		parent::doSave();
    	}
    }
    
    public function __construct(BaseObject $object = null, $options = array(), $CSRFSecret = null)
    {
        if ($object instanceof GuardUser)
        {
        	$object = $object->getsfGuardUserProfile();
        }
        parent::__construct($object, $options, $CSRFSecret);
    }
}
