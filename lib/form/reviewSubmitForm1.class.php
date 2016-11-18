<?php

/**
 * Journal of Structural Chemistry form
 *
 * @version SVN: $Id: reviewSubmitForm1.class.php 189 2010-04-12 08:58:36Z я $
 */
class reviewSubmitForm1 extends ReviewBaseForm {
    
    const EXC   = 5;
    const GOOD  = 4;
    const SATIS = 3;
    const BAD   = 2;
    
    const MANUSCR    = 0;
    const REPORT     = 1;
    const REVIEW     = 2;
        
    public function configure()
    {
        $array_char = array(
          self::MANUSCR    => sfContext::getInstance()->getI18N()->__('manuscript', array(), 'reviewForm1'),
          self::REPORT     => sfContext::getInstance()->getI18N()->__('report', array(), 'reviewForm1'),
          self::REVIEW     => sfContext::getInstance()->getI18N()->__('review', array(), 'reviewForm1'),
        );
        $array_bool = array(
          1 => sfContext::getInstance()->getI18N()->__('yes'),
          0 => sfContext::getInstance()->getI18N()->__('no')
        );
               
        $this->setWidget('user_id',  new sfWidgetFormInputHidden());
        $this->setWidget('manuscript_id', new sfWidgetFormInputHidden());
        $this->setWidget('matches', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
        $this->setWidget('gen_char', new sfWidgetFormChoice(array(
              'choices'=>$array_char)));
        $this->setWidget('short', new sfWidgetFormTextarea());
        $this->setWidget('rules', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
        $this->setWidget('keywords', new sfWidgetFormChoice(array(
              'choices' => $array_bool,
              'expanded' => true)));
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
        $this->setValidator('rules', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('keywords', new sfValidatorChoice(array(
              'choices' => array_keys($array_bool))));
        $this->setValidator('short', new sfValidatorString(array('required'=>true)));
        $this->setValidator('comments', new sfValidatorString(array('required'=>false)));
        $this->setValidator('comments_hidden', new sfValidatorString(array('required'=>false)));
        $this->setValidator('file', new myValidatorFile(array('mime_types'=>sfConfig::get('app_file_mime'),
                                                   'max_size'=>sfConfig::get('app_file_size'),
                                                    'required'=>false)));
        
        $this->validatorSchema->setPostValidator(new sfValidatorPropelUnique(array('model'=>'review', 'column'=>array('manuscript_id', 'user_id'))));
        $this->widgetSchema->setNameFormat('submit_review[%s]');
        $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
        $this->widgetSchema->setLabels(array(
          'gen_char'      => 'Submission type',
          'matches'       => 'Matches the scope of Journal of Structural Chemistry',
          'recommend'     => "Reviewer's recommendations",
          'comments'      => "Reviewer's comments",
          'rules'         => "Is manuscript correctly formatted",
          'keywords'      => "Are title and keywords appropriate",
          'short'         => "State in brief, what are the main points and contribution of the work",
          'comments_hidden'=>"Comments for editor only"
         ));
         
         $this->setProtectedFields(array('comments_hidden'));
         
         $this->widgetSchema->getFormFormatter()->setTranslationCatalogue('reviewForm1');
    }
}
?>