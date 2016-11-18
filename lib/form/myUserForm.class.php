<?php
class myUserForm extends sfForm
{
	protected $isNew = true;
	public function __construct($defaults = array(), $options = array(), $CSRFSecret = null)
	{
		if (!empty($defaults)) $this->isNew = false;
		parent::__construct($defaults, $options, $CSRFSecret);
	}
	public function isNew()
	{
		return $this->isNew;
	}
	
	public function configure()
	{
		$this->setWidgets(array(
			'username' => new sfWidgetFormInput(),
			'password' => new sfWidgetFormInputPassword(),
			'password_bis' => new sfWidgetFormInputPassword()
		));
		$this->widgetSchema->setNameFormat('user[%s]');
    	$this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    	
    	$this->setValidators(array(
    		'username' => new sfValidatorString(),
    		'password' => new sfValidatorString(),
    		'password_bis' => new sfValidatorString()
    	));
    	$this->validatorSchema->setPostValidator(new sfValidatorAnd(array(
      		new sfValidatorCallback(array('callback'=>array($this, 'checkDuplicate'), 'arguments'=>'' )),
      		new sfValidatorSchemaCompare('password_bis', '==', 'password',
      										array(),
      										array('invalid'=>'Passwords do not match'))
    	)));
    	$this->widgetSchema->setLabel('password_bis', 'Retype password');
    	$this->widgetSchema->setHelps(array(
    	'username'=>'Name used to log in to the system',
    	'password_bis'=>'Retype password to make sure you made no mistake'
    	));
	}
 	public function checkDuplicate ($validator, $values, $arguments)
  	{
  		$c = new Criteria();
  		$c->add(sfGuardUserPeer::USERNAME, $values['username']);
  		$r = sfGuardUserPeer::doSelectOne($c);
  		if ($this->isNew)
  		{
  			if ( $r ) throw new sfValidatorError($validator, 'Such username already exists');
  		}
  		else
  		{
  			if ( !$r ) throw new sfValidatorError($validator, 'No such record');
  		}
  		return $values;
  	}
}
?>