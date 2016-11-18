<?php
class reviewSubmitForm extends ReviewBaseForm {
	
	const EXC   = 5;
	const GOOD  = 4;
	const SATIS = 3;
	const BAD   = 2;
	
	const THEOR      = 0;
	const EXPER      = 1;
	const REVIEW     = 2;
	const COMMUNIC   = 3;
	const NEW_METHOD = 4;
	
	const BAD_STYLE    = 0;
	const BAD_TEXT     = 1;
	const BAD_ILLUSTR  = 2;
	const BAD_BIBL     = 3;
	const MANY_FORMUL  = 4;
	const MANY_PICS    = 5;
	const MANY_TABLES  = 6;
	
	public function configure()
	{
		$array_char = array(
		  self::THEOR      => sfContext::getInstance()->getI18N()->__('theoretical', array(), 'reviewForm'),
		  self::EXPER      => sfContext::getInstance()->getI18N()->__('experimental', array(), 'reviewForm'),
		  self::REVIEW     => sfContext::getInstance()->getI18N()->__('review', array(), 'reviewForm'),
		  self::COMMUNIC   => sfContext::getInstance()->getI18N()->__('communication', array(), 'reviewForm'),
		  self::NEW_METHOD => sfContext::getInstance()->getI18N()->__('new method', array(), 'reviewForm')
		);
		$array_bool = array(
		  1 => sfContext::getInstance()->getI18N()->__('yes'),
		  0 => sfContext::getInstance()->getI18N()->__('no')
		);
		$array_grade = array(
		  self::EXC   => sfContext::getInstance()->getI18N()->__('excellent', array(), 'reviewForm'),
		  self::GOOD  => sfContext::getInstance()->getI18N()->__('good', array(), 'reviewForm'),
		  self::SATIS => sfContext::getInstance()->getI18N()->__('satisfactory', array(), 'reviewForm'),
		  self::BAD   => sfContext::getInstance()->getI18N()->__('bad', array(), 'reviewForm')
		);
		$array_remark = array(
		  self::BAD_STYLE     => sfContext::getInstance()->getI18N()->__('Poor style', array(), 'reviewForm'),
		  self::BAD_TEXT      => sfContext::getInstance()->getI18N()->__('Poor text quality (numerous misprints)', array(), 'reviewForm'),
		  self::BAD_ILLUSTR   => sfContext::getInstance()->getI18N()->__('Technically poor illustrations', array(), 'reviewForm'),
		  self::BAD_BIBL      => sfContext::getInstance()->getI18N()->__('Poor bibliography', array(), 'reviewForm'),
		  self::MANY_FORMUL   => sfContext::getInstance()->getI18N()->__('Too many formulae', array(), 'reviewForm'),
		  self::MANY_PICS     => sfContext::getInstance()->getI18N()->__('Too many figures', array(), 'reviewForm'),
		  self::MANY_TABLES   => sfContext::getInstance()->getI18N()->__('Too many tables', array(), 'reviewForm')
		);
				
		$this->setWidget('user_id',  new sfWidgetFormInputHidden());
		$this->setWidget('manuscript_id', new sfWidgetFormInputHidden());
		$this->setWidget('gen_char', new sfWidgetFormChoice(array(
		      'choices'=>$array_char)));
		$this->setWidget('matches', new sfWidgetFormChoice(array(
		      'choices' => $array_bool,
		      'expanded' => true)));
		$this->setWidget('send_to', new sfWidgetFormInput());
		$this->setWidget('mat_original', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
		$this->setWidget('published_before_full', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
		$this->setWidget('published_before_part', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
		$this->setWidget('new_theor', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
		$this->setWidget('new_exp', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
//		  'not_new' => new sfWidgetFormChoice(array(
//              'choices' => $array_bool,
//              'expanded' => true)),
		$this->setWidget('error', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
		$this->setWidget('original', new sfWidgetFormChoice(array(
              'choices' => $array_grade,
              'expanded' => true)));
		$this->setWidget('present', new sfWidgetFormChoice(array(
              'choices' => $array_grade,
              'expanded' => true)));
		$this->setWidget('total', new sfWidgetFormChoice(array(
              'choices' => $array_grade,
              'expanded' => true)));
		$this->setWidget('remarks', new sfWidgetFormChoice(array(
		      'choices' => $array_remark,
		      'multiple' => true,
		      'expanded' => true )));
		$this->setWidget('reduce_by', new sfWidgetFormInput());
		$this->setWidget('comments', new sfWidgetFormTextarea());
		$this->setWidget('comments_hidden', new sfWidgetFormTextarea());
		$this->setWidget('file', new sfWidgetFormInputFile());
      
		
		$c_valid = new Criteria();
        $c_valid->add(sfGuardUserProfilePeer::IS_REVIEWER, true);
		
		$this->setValidator('user_id', new sfValidatorPropelChoice(array(
              'model'    => 'sfGuardUserProfile',
              'criteria' => $c_valid
           )));
		$this->setValidator('manuscript_id', new sfValidatorPropelChoice(array('model'=>'manuscript')));
		$this->setValidator('gen_char', new sfValidatorChoice(array(
              'choices'=> array_keys($array_char))));
        $this->setValidator('matches', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('send_to', new sfValidatorString(array('required'=>false)));
        $this->setValidator('mat_original', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('published_before_full', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('published_before_part',new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('new_theor', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('new_exp', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
//          'not_new' => new sfValidatorChoice(array(
//              'choices' => array_keys($array_bool))),
        $this->setValidator('error', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('original', new sfValidatorChoice(array(
              'choices' => array_keys($array_grade))));
        $this->setValidator('present',new sfValidatorChoice(array(
              'choices' => array_keys($array_grade))));
        $this->setValidator('total', new sfValidatorChoice(array(
              'choices' => array_keys($array_grade))));
        $this->setValidator('remarks', new sfValidatorChoice(array(
              'choices' => array_keys($array_remark),
              'multiple' => true,
		      'required' => false
          )));
        $this->setValidator('reduce_by', new sfValidatorInteger(array('min'=>0, 'max'=>100, 'required'=>false)));
        $this->setValidator('comments', new sfValidatorString(array('required'=>false)));
        $this->setValidator('comments_hidden', new sfValidatorString(array('required'=>false)));
        $this->setValidator('file', new myValidatorFile(array('mime_types'=>sfConfig::get('app_file_mime'),
                                                   'max_size'=>sfConfig::get('app_file_size'),
                                                    'required'=>false)));
        
		$this->validatorSchema->setPostValidator(new sfValidatorPropelUnique(array('model'=>'review', 'column'=>array('manuscript_id', 'user_id'))));
		$this->widgetSchema->setNameFormat('submit_review[%s]');
		$this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
		$this->widgetSchema->setLabels(array(
		  'gen_char'      => 'General character',
		  'matches'       => 'Matches scope of journal',
		  'send_to'       => 'Suggested submitting to',
		  'mat_original'  => 'Material is original',
		  'published_before_full' => 'Material was fully published before',
		  'published_before_part' => 'Material was partly published before',
		  'new_theor'     => 'Material contains new theoretical data',
		  'new_exp'       => 'Material contains new experimental data',
		  'not_new'       => 'Material does not contain considerably new data',
          'error'         => 'Material contains a number of erroneous statements and/or experimental data',
		  'original'      => 'Originality',
		  'present'       => 'Presentation',
   		  'total'         => 'Total',
		  'recommend'     => "Reviewer's recommendations",
          'remarks'       => "Additional remarks",
		  'reduce_by'     => 'Reduce by (in %)',
		  'comments'      => "Reviewer's comments",
		  'comments_hidden'=>"Comments for editor"
		 ));
		 $this->widgetSchema['reduce_by']->setAttribute('size', '4');
		 $this->widgetSchema['send_to']->setAttribute('size', '50');
		 
		 $this->setProtectedFields(array('comments_hidden'));
		 
		 $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('reviewForm');
	}
}
?>