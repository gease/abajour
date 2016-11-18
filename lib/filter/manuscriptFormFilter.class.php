<?php

/**
 * manuscript filter form.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: manuscriptFormFilter.class.php 141 2009-06-07 13:19:26Z я $
 */
class manuscriptFormFilter extends BasemanuscriptFormFilter
{
  public function configure()
  {
  	$years = range(sfConfig::get('app_journal_years_min'),sfConfig::get('app_journal_years_max'));
  	$years = array_combine($years, $years);
  	$statuses = array(
  	 manuscriptPeer::SUBMITTED,
  	 manuscriptPeer::ACCEPTED_REVIEW,
  	 manuscriptPeer::UNDER_REVIEW,
  	 manuscriptPeer::AFTER_REVIEW,
  	 manuscriptPeer::ACCEPTED_PUBL,
  	 manuscriptPeer::PENDING,
  	 manuscriptPeer::PUBLISHED,
  	 manuscriptPeer::REJECT,
  	 manuscriptPeer::UNDER_REWRITE,
  	 manuscriptPeer::REVIEWER_REJECT,
  	 manuscriptPeer::REVIEWER_REFUSED,
  	 manuscriptPeer::REVIEW_FINAL
  	);
  	$statuses = array_combine($statuses, array_map(array(sfContext::getInstance()->getI18n(), '__'), array_map(array('manuscriptPeer', 'statusString'), $statuses)));
  	$this->setWidget('status', new sfWidgetFormChoiceMany(array(
  	     'choices'=>$statuses,
  	     'multiple'=>true,
  	     'expanded'=>true
  	)));
  	$this->widgetSchema['title']->setOption('with_empty', false);
  	$c = new Criteria();
  	$c->add(sfGuardUserProfilePeer::IS_REVIEWER, true);
  	$c->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    $this->widgetSchema['review_list']->setOption('criteria', $c);
    $this->widgetSchema['city_id']->setOption('order_by', array('Name', 'asc'));
    $this->setWidget('user_manuscript_ref_list', new sfWidgetFormFilterInput(array('with_empty'=>false)));
    $this->setWidget('date_submitted', new sfWidgetFormFilterDate(array(
        'with_empty'=> false,
        'from_date' => new sfWidgetFormI18nDate(array('culture'=>sfContext::getInstance()->getI18N()->getCulture(), 'years' => $years)),
        'to_date'   => new sfWidgetFormI18nDate(array('culture'=>sfContext::getInstance()->getI18N()->getCulture(), 'years' => $years)),
        'template'  => sfContext::getInstance()->getI18n()->__('from').' %from_date%<br>'.sfContext::getInstance()->getI18n()->__('to').' %to_date%'
    )));
//
    $this->validatorSchema['review_list']->setOption('criteria', $c);
  	$this->setValidator('status', new sfValidatorChoiceMany(array('choices'=>array_keys($statuses),'required'=>false)));
  	$this->setValidator('user_manuscript_ref_list', new sfValidatorPass());
  	$this->setValidator('date_submitted', new sfValidatorDateRange(array(
  	     'from_date' => new sfValidatorDate(array('required'  => false)),
  	     'to_date'   => new sfValidatorDate(array('required'  => false)),
  	     'required'  => false
  	)));
  	
  	$this->widgetSchema->setLabel('user_manuscript_ref_list', 'Authors');
  	$this->widgetSchema->setLabel('review_list', 'Reviewers');
  	$this->widgetSchema->setLabel('city_id', 'City');
  	
  }
  
    public function adduserManuscriptRefListColumnCriteria(Criteria $criteria, $field, $values)
    {
      if (isset($values['text']) && '' != trim($values['text']))
      {
        //$criteria->add(sfGuardUserProfilePeer::LAST_NAME, '%'.$values['text'].'%', Criteria::LIKE);
        $criteria->addJoin(sfGuardUserProfilePeer::USER_ID, userManuscriptRefPeer::USER_ID, Criteria::JOIN);
        $criteria->addJoin(userManuscriptRefPeer::MANUSCRIPT_ID, manuscriptPeer::ID);
        $criteria->add(sfGuardUserProfilePeer::LAST_NAME, '%'.$values['text'].'%', Criteria::LIKE);
        $criteria->setDistinct();
      }
      else return;
    }

    public function addStatusColumnCriteria (Criteria $criteria, $field, $values)
    {
        if (!is_array($values))
        {
            $values = array($values);
        }

        if (!count($values))
        {
            return;
        }

        $value = array_pop($values);
        $criterion = $criteria->getNewCriterion(manuscriptPeer::STATUS, $value);

        foreach ($values as $value)
        {
            $criterion->addOr($criteria->getNewCriterion(manuscriptPeer::STATUS, $value));
        }

        $criteria->add($criterion);
    }
    
    public function addDateSubmittedColumnCriteria (Criteria $criteria, $field, $values)
    {
    	if (is_null($values['from']) && is_null($values['to'])) return;
        $criteria->add(actionPeer::STATUS_BEFORE, manuscriptPeer::CREATED);
        $criteria->add(actionPeer::STATUS_AFTER, manuscriptPeer::SUBMITTED);
        if (!is_null($values['from']))
        {
        	$criteria->add(actionPeer::DATETIME, $values['from'], Criteria::GREATER_EQUAL );
        }
        if (!is_null($values['to']))
        {
            $criteria->addAnd(actionPeer::DATETIME, $values['to'], Criteria::LESS_EQUAL );
        }
        $criteria->addJoin(manuscriptPeer::ID, actionPeer::MANUSCRIPT_ID, Criteria::INNER_JOIN);
    }
    
    public function getFields()
    {
        return array(
         'id'                       => 'Text',
         'title'                    => 'Text',
         'status'                   => 'Text',
         'pages'                    => 'Text',
         'city_id'                  => 'ForeignKey',
         'review_list'              => 'ManyKey',
         'user_manuscript_ref_list' => 'ManyKey',
         'date_submitted'           => 'Date'
        );
    }
}
