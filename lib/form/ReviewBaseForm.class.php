<?php
/**
 * Prototype for review forms
 *
 * @todo Написать функцию показа данных рецензии, с учётом того что есть защищённые поля
 * @version SVN: $Id: ReviewBaseForm.class.php 190 2010-05-18 14:15:10Z я $
 */

class ReviewBaseForm extends sfFormPropel  {
	
	protected $protectedFields = array();

	public function setup(){
	   $array_recommend = array(
          reviewPeer::ACCEPT           => sfContext::getInstance()->getI18N()->__(reviewPeer::outcomeString(reviewPeer::ACCEPT)),
          reviewPeer::ACCEPT_SMALL     => sfContext::getInstance()->getI18N()->__(reviewPeer::outcomeString(reviewPeer::ACCEPT_SMALL)),
          reviewPeer::ACCEPT_COMMENT   => sfContext::getInstance()->getI18N()->__(reviewPeer::outcomeString(reviewPeer::ACCEPT_COMMENT)),
        //reviewPeer::REVISE           => sfContext::getInstance()->getI18N()->__(reviewPeer::outcomeString(reviewPeer::REVISE)),
          reviewPeer::REJECT           => sfContext::getInstance()->getI18N()->__(reviewPeer::outcomeString(reviewPeer::REJECT))
        );
	   parent::setup();
	   $formatter = new myWidgetFormSchemaFormatterTable($this->getWidgetSchema(), $this->getValidatorSchema());
       $this->getWidgetSchema()->addFormFormatter('my_table', $formatter);
       $formatter_disabled = new myWidgetFormSchemaFormatterTableDisabled($this->getWidgetSchema());
       $this->getWidgetSchema()->addFormFormatter('my_table_disabled', $formatter_disabled);
       $this->getWidgetSchema()->setFormFormatterName('my_table');
       
       $this->setWidget('recommend', new sfWidgetFormChoice(array(
              'choices' => $array_recommend )));
       $this->setValidator('recommend', new sfValidatorChoice(array(
              'choices' => array_keys($array_recommend))));
	}
	
	protected function updateDefaultsFromObject()
    {
       if ($this->isNew)
        {
            $this->setDefaults(array_merge($this->object->toArray(BasePeer::TYPE_FIELDNAME), $this->getDefaults()));
        }
        else
        {
            if ( $contents = $this->object->getContents())
                $this->setDefaults(array_merge($this->getDefaults(), $this->object->toArray(BasePeer::TYPE_FIELDNAME), unserialize($contents)));
            else
                $this->setDefaults(array_merge($this->getDefaults(), $this->object->toArray(BasePeer::TYPE_FIELDNAME)));
            
        }
    }
    
    public function updateObject ($values = null)
    {
        if ($values == null) $values = $this->getValues();
        $this->object->setManuscriptId($values['manuscript_id']);
        $this->object->setUserId($values['user_id']);
        $this->object->setContents(serialize($values));
        $this->object->setOutcome($values['recommend']);
        return $this->object;
    }

    public function getJavaScripts()
    {
        return array('tiny_mce/tiny_mce.js');
    }
	
	public function renderDisabled($with_file = false, $with_hidden = false) {
		$translationCatalogue = $this->widgetSchema->getFormFormatter()->getTranslationCatalogue();
		$this->widgetSchema->setFormFormatterName('my_table_disabled');
		$this->widgetSchema->getFormFormatter()->setTranslationCatalogue($translationCatalogue);
		$widgetSchema = $this->getWidgetSchema();
		$names = $widgetSchema->getPositions();
		$rows = array();
		$formFormat = $widgetSchema->getFormFormatter();
		foreach ($names as $name)
		{
			//if (!$this->checkAccess($name)) continue;
			if (!$with_hidden && in_array($name, $this->protectedFields)) continue;
			if ($widgetSchema[$name]->isHidden()) continue;
			$value = $this[$name]->getValue();
			if ($value=='' && !($widgetSchema[$name] instanceof sfWidgetFormInputFile)) continue;
			if ($widgetSchema[$name] instanceof sfWidgetFormChoice)
			{
				$choices = $widgetSchema[$name]->getOption('choices');
				if (is_array($value))
				{
					$values = array();
					foreach ($value as $v) $values[] = $choices[$v];
					$value = $formFormat->formatChoices($values);
				}
				else $value = $choices[$value];
			}
			if ($widgetSchema[$name] instanceof sfWidgetFormInputFile )
			{
				if (!$with_file) continue;
				if ($this->getObject()->getFilename())
				    $value = link_to(__('File'), 'review_file',$this->getObject(), array('popup'=>true));
				else continue;
			}
			$label =  $widgetSchema->getFormFormatter()->generateLabelName($name);
			$rows[] = $formFormat->formatRow($label, $value, null,  $widgetSchema->getHelp($name));
		}
		return implode('', $rows);
	}
	
    public function getModelName()
    {
        return 'review';
    }
    
    /**
     * Indicates which fields should be shown to editor only
     * @param $fields array of field names
     */
    protected function setProtectedFields ($fields=array())
    {
    	if (!is_array($fields))
    	   throw new InvalidArgumentException('Array expected');
    	$this->protectedFields = $fields;
    }
    
    /**
     * Checks if current user may see the field
     * @param $name field name
     */
    private function checkAccess ($name)
    {
    	if (!in_array($name, $this->protectedFields)) return true;
    	if (sfContext::getInstance()->getUser()->hasCredential('admin')) return true;
    	return false;
    }
}
?>