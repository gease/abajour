<?php

/**
 * review form.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: reviewForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class reviewForm extends BasereviewForm
{
  public function configure()
  {
  	$choices = array(
  	     sfContext::getInstance()->getI18N()->__('Decline'),
  	     sfContext::getInstance()->getI18N()->__('Accept')
  	);
  	unset($this['outcome'], $this['contents'], $this['submitted']);
  	$this->widgetSchema['decision'] = new sfWidgetFormChoice(array('choices'=>$choices));
  	$this->validatorSchema['decision'] = new sfValidatorChoice(array('choices'=>array_keys($choices)));
  }
  
  public function updateObject ($values = null)
  {
        if ($values == null) $values = $this->getValues();
        $this->object->setManuscriptId($values['manuscript_id']);
        $this->object->setUserId($values['user_id']);
        $this->object->setDecision($values['decision']);
        return $this->object;
  }
    
}
