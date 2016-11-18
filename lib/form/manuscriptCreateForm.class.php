<?php

/**
 * manuscript form.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: manuscriptCreateForm.class.php 177 2010-03-06 20:11:45Z я $
 */
class manuscriptCreateForm extends BasemanuscriptForm
{
  public function configure()
  {
  	sfProjectConfiguration::getActive()->loadHelpers('RenderForm');
  	unset($this['status'], $this['review_list'], $this['city_id'], $this['pages'],
  	      /*$this['user_manuscript_ref_list'],*/ $this['comment'], $this['keyword_manuscript_ref_list']);
  	$this->widgetSchema['title'] = new sfWidgetFormTextarea();
  	$this->widgetSchema['file'] = new sfWidgetFormInputFile();
  	if ($this->getOption('archive_file', false)) $this->widgetSchema['archive_file'] = new sfWidgetFormInputFile();
  	$this->widgetSchema['corresponding'] = new sfWidgetFormSelectRadio(array('choices'=>array()));
  	$this->widgetSchema['number_recommended'] = new sfWidgetFormInputHidden();
  	$this->widgetSchema['number_not_recommended'] = new sfWidgetFormInputHidden();
  	$this->validatorSchema['file'] = new myValidatorFile(array('mime_types'=>sfConfig::get('app_file_mime'),
  																'max_size'=>sfConfig::get('app_file_size') ));
  	if ($this->getOption('archive_file', false)) $this->validatorSchema['archive_file'] = new myValidatorFile(array('mime_types'=>sfConfig::get('app_file_archive_mime'),
                                                                'max_size'=>sfConfig::get('app_file_size'), 'required'=>false ));
 
  	$this->widgetSchema['user_manuscript_ref_list'] = new sfWidgetFormSelectMany(array('choices'=>array()));
  	$this->validatorSchema['corresponding'] = new sfValidatorPropelChoice(array('model'=>'sfGuardUser', 'required'=>true));
  	$this->validatorSchema['number_recommended'] = new sfValidatorInteger();
  	$this->validatorSchema['number_not_recommended'] = new sfValidatorInteger();
  	$this->embedForm('recommended_fields', new RecommendedReviewerForm());
  	$this->validatorSchema['recommended_fields'] = new sfValidatorPass();
  	$this->widgetSchema->setLabel('user_manuscript_ref_list', 'Authors');
//  	$this->widgetSchema->setLabel('keyword_manuscript_ref_list', 'Keywords from list');
  	$this->widgetSchema->setLabel('letter', 'Accompanying letter');
  	$this->widgetSchema->setLabel('archive_file', 'Zipped extra files');
  	$this->widgetSchema['title']->setAttributes(array('rows'=>1, 'cols'=>50, 'size'=>50, 'maxlength'=>$this->validatorSchema['title']->getOption('max_length')));
  	$this->widgetSchema['keywords_freetext']->setAttributes(array('size'=>50, 'maxlength'=>$this->validatorSchema['keywords_freetext']->getOption('max_length')));
  	$this->widgetSchema->setHelps(array(
  	 'user_manuscript_ref_list'=>'Choose from appearing pop-up. Move with the mouse to set the order. Check corresponding author with radiobutton.',
  	 'file' =>array('File in %1 format, maximal size %2 Mb', array('%1'=>show_file_formats(), '%2'=>intval(sfConfig::get('app_file_size')/(1024*1024)))),
  	 'archive_file' =>array('File in %1 format, maximal size %2 Mb', array('%1'=>show_file_formats(true), '%2'=>intval(sfConfig::get('app_file_size')/(1024*1024))))
  	));
  	$this->validatorSchema['corresponding']->setMessages(array(
  	 'required'=>'You need to indicate corresponding author',
  	 'invalid' =>'Invalid corresponding author'));
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
  	$number_recommended = $this->validatorSchema['number_recommended']->clean($taintedValues['number_recommended']);
    $number_not_recommended = $this->validatorSchema['number_not_recommended']->clean($taintedValues['number_not_recommended']);
    if ($number_recommended > 0)
        $this->embedFormForEach('recommended', new RecommendedReviewerForm(), $number_recommended);
    if ($number_not_recommended > 0)
        $this->embedFormForEach('not_recommended', new RecommendedReviewerForm(), $number_not_recommended);
  	parent::bind($taintedValues, $taintedFiles);
  	if (!$this->isValid())
  	{
  		$authors = array();
  		foreach ($this->taintedValues['user_manuscript_ref_list'] as $auth_id) $authors[$auth_id] = sfGuardUserProfilePeer::retrieveByPk($auth_id);
  	    $this->widgetSchema['user_manuscript_ref_list']->setOption('choices', $authors);
  	}
  }

  public function updateObject ($values = null)
  {
  	$this->values['reviewers_request'] = serialize(array('recommended'=>$this->values['recommended'], 'not_recommended'=>$this->values['not_recommended']));
  	parent::updateObject($values);
  }
  
  public function saveuserManuscriptRefList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['user_manuscript_ref_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(userManuscriptRefPeer::MANUSCRIPT_ID, $this->object->getPrimaryKey());
    userManuscriptRefPeer::doDelete($c, $con);

    $values = $this->getValue('user_manuscript_ref_list');
    if (is_array($values))
    {
      for ($i=0; $i < count($values); $i++)
      {
        $obj = new userManuscriptRef();
        $obj->setManuscriptId($this->object->getPrimaryKey());
        $obj->setUserId($values[$i]);
        $obj->setAuthorOrder($i);
        if ($values[$i] == $this->getValue('corresponding')) $obj->setIsCorrespondingAuthor(true);
        $obj->save();
      }
    }
  }
}
