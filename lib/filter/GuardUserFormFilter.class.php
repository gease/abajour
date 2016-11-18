<?php

/**
 * GuardUser filter form.
 *
 * @package    magazine
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: GuardUserFormFilter.class.php 141 2009-06-07 13:19:26Z я $
 */
class GuardUserFormFilter extends BaseGuardUserFormFilter
{
  public function configure()
  {
  	$translated = sfContext::getInstance()->getI18N()->__('is empty');
  	$template = sfContext::getInstance()->getI18N()->__('from').' %from_date%<br />'.sfContext::getInstance()->getI18N()->__('to').' %to_date%';
  	$this->widgetSchema['last_name']->setOption('empty_label',$translated);
    $this->widgetSchema['first_name']->setOption('empty_label',$translated);
    $this->widgetSchema['institution']->setOption('empty_label',$translated);
    $this->widgetSchema['email']->setOption('with_empty',false);
    $this->widgetSchema['city_id']->setOption('multiple',true);
    $this->widgetSchema['city_id']->setOption('add_empty',false);
    $this->widgetSchema['city_id']->setOption('order_by',array('Name', 'asc'));
    $this->widgetSchema['city_id']->setAttribute('size','15');
  	$this->widgetSchema['birthday'] = new sfWidgetFormFilterDate(array('from_date' => new myBirthdayWidget(), 'to_date' => new myBirthdayWidget(), 'with_empty' => false, 'template' => $template));
  	$this->widgetSchema['gender'] = new sfWidgetFormSelect(array('choices'=>array(
  	     null => null,
         'M'=>sfContext::getInstance()->getI18N()->__('male'),
         'F'=>sfContext::getInstance()->getI18N()->__('female'))
  	));
  	$this->validatorSchema['gender'] = new sfValidatorChoice(array('choices'=>array('M', 'F'), 'required'=>false));
  	$this->widgetSchema->setLabel('birthday', 'Date of birth');
  	$this->widgetSchema['is_active']->setOption('choices', array(
  	     ''=>sfContext::getInstance()->getI18N()->__('yes or no'),
  	     1 => sfContext::getInstance()->getI18N()->__('yes'),
  	     0 => sfContext::getInstance()->getI18N()->__('no')
  	));
  	$this->widgetSchema['is_reviewer']->setOption('choices', array(
         ''=>sfContext::getInstance()->getI18N()->__('yes or no'),
         1 => sfContext::getInstance()->getI18N()->__('yes'),
         0 => sfContext::getInstance()->getI18N()->__('no')
    ));
    $this->widgetSchema['manuscripts'] = new sfWidgetFormFilterInput(array('with_empty'=>false));
    $this->validatorSchema['manuscripts'] = new sfValidatorPass();
    $this->widgetSchema['reviews'] = new sfWidgetFormFilterInput(array('with_empty'=>false));
    $this->validatorSchema['reviews'] = new sfValidatorPass();
    $this->widgetSchema['reviewed_authors'] = new sfWidgetFormFilterInput(array('with_empty'=>false));
    $this->validatorSchema['reviewed_authors'] = new sfValidatorPass();
    $this->validatorSchema['city_id']->setOption('multiple', true);
    $this->widgetSchema['city_id']->setLabel('City');
    
  }
  
  public function getFields()
  {
    return array(
      'id'                 => 'Text',
      'first_name'         => 'Text',
      'last_name'          => 'Text',
      'middle_name'        => 'Text',
      'birthday'           => 'Date',
      'gender'             => 'Text',
      'country'            => 'Text',
      'city_id'            => 'ForeignKey',
      'institution'        => 'Text',
      'address'            => 'Text',
      'is_address_private' => 'Boolean',
      'email'              => 'Text',
      'qualification'      => 'Text',
      'is_reviewer'        => 'Boolean',
      'username'           => 'Text',
      'created_at'         => 'Date',
      'last_login'         => 'Date',
      'is_active'          => 'Boolean',
      'is_super_admin'     => 'Boolean',
      'manuscripts'        => 'Text',
      'reviews'            => 'Text',
      'reviewed_authors'   => 'Text'
    );
  }
  
  public function addManuscriptsColumnCriteria (Criteria $criteria, $field, $values)
  {
      if (isset($values['text']) && '' != trim($values['text']))
      {
        $criteria->add(manuscriptPeer::TITLE, '%'.$values['text'].'%', Criteria::LIKE);
        $criteria->addJoin(manuscriptPeer::ID, userManuscriptRefPeer::MANUSCRIPT_ID, Criteria::JOIN);
        $criteria->addJoin(userManuscriptRefPeer::USER_ID, GuardUserPeer::ID);
        $criteria->setDistinct();
      }
      else return;
  }
  
  public function addReviewsColumnCriteria (Criteria $criteria, $field, $values)
  {
      if (isset($values['text']) && '' != trim($values['text']))
      {
        $criteria->add(manuscriptPeer::TITLE, '%'.$values['text'].'%', Criteria::LIKE);
        $criteria->addJoin(manuscriptPeer::ID, reviewPeer::MANUSCRIPT_ID, Criteria::JOIN);
        $criteria->addJoin(ReviewPeer::USER_ID, GuardUserPeer::ID);
        $criteria->setDistinct();
      }
      else return;
  }
  
  public function addReviewedAuthorsColumnCriteria (Criteria $criteria, $field, $values)
  {
      if (isset($values['text']) && '' != trim($values['text']))
      {
        $criteria->add(sfGuardUserProfilePeer::LAST_NAME, '%'.$values['text'].'%', Criteria::LIKE);
        $criteria->addJoin(sfGuardUserProfilePeer::USER_ID, userManuscriptRefPeer::USER_ID, Criteria::JOIN);
        $criteria->addJoin(userManuscriptRefPeer::MANUSCRIPT_ID, reviewPeer::MANUSCRIPT_ID, Criteria::JOIN);
        $criteria->addJoin(reviewPeer::USER_ID, GuardUserPeer::ID);
        $criteria->setDistinct();
      }
      else return;
  }
  
  public function addGenderColumnCriteria (Criteria $criteria, $field, $values)
  {
      if (isset($values) && '' != trim($values))
      {
        $criteria->add(GuardUserPeer::GENDER, $values);
      }
      else return;
  }
}
