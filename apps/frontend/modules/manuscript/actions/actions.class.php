<?php

/**
 * manuscript actions.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 187 2010-03-29 07:51:54Z я $
 */

require_once dirname(__FILE__).'/../lib/manuscriptGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/manuscriptGeneratorHelper.class.php';


/**
 * Manuscript actions.
 *
 * Модуль основан на админ генераторе (администраторская панель "управление статьями"). Тем не менее, дополняется ключевой для системы функциональностью
 * изменения состояния статьи (кнопка "изменить статус").
 *
 */
class manuscriptActions extends autoManuscriptActions
{
	/**
	 * Change status page.
	 *
	 * Генерация формы для изменения статуса статьи в зависимости от текущего статуса.
	 * @todo Переписать на основании class factory
	 */
	public function executeChangeStatus(sfWebRequest $request)
	{
		$this->manuscript = $this->getRoute()->getObject();
//		$this->manuscript = manuscriptPeer::retrieveByPK($request->getParameter('id'));
//		$this->getUser()->setAttribute('manuscript.status_old', $this->manuscript->getStatus()); //this is just to get the form name at changedStatus
		/* @var $this->manuscript manuscript */
		switch ($this->manuscript->getStatus())
		{
			case manuscriptPeer::SUBMITTED:
			case manuscriptPeer::AFTER_REVIEW:
		      switch ($this->manuscript->getStatus())
              {
                    case manuscriptPeer::SUBMITTED:
                        $choices = array(manuscriptPeer::REJECT, manuscriptPeer::ACCEPTED_REVIEW);
                        break;
                    case manuscriptPeer::AFTER_REVIEW:
                    	if (is_null($this->manuscript->getLastReview()->getDecision()))
                    	{
                    		if ($this->manuscript->getLastReview()->getOutcome() == reviewPeer::REJECT)
                    		  $choices = array(manuscriptPeer::REJECT);
                    		elseif ($this->manuscript->getLastReview()->getOutcome() == reviewPeer::ACCEPT)
                    		  $choices = array(manuscriptPeer::PENDING);
                    		else
                                $choices = array(manuscriptPeer::REJECT, manuscriptPeer::PENDING, manuscriptPeer::UNDER_REWRITE);
                    	}
                        elseif ($this->manuscript->getLastReview()->getDecision() == 0)
                            $choices = array(manuscriptPeer::REJECT);
                        elseif ($this->manuscript->getLastReview()->getDecision() == 1)
                            $choices = array(manuscriptPeer::PENDING);
                        break;
                }
				$this->form = new manuscriptChangeStatusForm($this->manuscript, array('choices'=>$choices));
				break;
			case manuscriptPeer::ACCEPTED_REVIEW:
			case manuscriptPeer::REVIEWER_REFUSED:
			case manuscriptPeer::REVIEWER_REJECT:
				$this->form = new manuscriptReviewerForm($this->manuscript);
				break;
			case manuscriptPeer::UNDER_REVIEW:
				$this->form = new reviewProceedForm($this->manuscript);
                break;
		    case manuscriptPeer::REVIEW_FINAL:
//                $this->form = new manuscriptReviewForm($this->manuscript);
                  $this->redirect('@edit_review_final?manuscript_id='.$this->manuscript->getId().'&user_id='.$this->manuscript->getCurrentReviewer()->getId());
                break;
			case manuscriptPeer::UNDER_REWRITE:
				$this->redirect(array(
				    'module'    =>  'paper',
				    'action'    =>  'createReply',
				    'id'        =>  $this->manuscript->getId()
				));
				break;
			case manuscriptPeer::PENDING:
				$publication = new Publication();
				$publication->setmanuscript($this->manuscript);
				$this->form = new PublicationForm($publication);
				break;
			default: break;
		}
	}
	
	/**
	 * Change status request processing
	 *
	 * Обработка формы с изменением статуса.
	 * Валидация, сохранение, если надо, редирект, если надо - отправка почтового сообщения.
	 * @todo Переписать на основе class factory, вынести всю пост-обработку (типа редиректов) в формы,
	 * почту тоже оформить приличней
	 */
	public function executeChangedStatus(sfWebRequest $request)
	{
//		$status_old = $this->getUser()->getAttribute('manuscript.status_old');
        $this->manuscript = $this->getRoute()->getObject();
		switch ($this->manuscript->getStatus())
		{
			case manuscriptPeer::SUBMITTED:
			case manuscriptPeer::AFTER_REVIEW:
				switch ($this->manuscript->getStatus())
				{
					case manuscriptPeer::SUBMITTED:
						$choices = array(manuscriptPeer::REJECT, manuscriptPeer::ACCEPTED_REVIEW);
						break;
					case manuscriptPeer::AFTER_REVIEW:
                        if (is_null($this->manuscript->getLastReview()->getDecision()))
                            $choices = array(manuscriptPeer::REJECT, manuscriptPeer::PENDING, manuscriptPeer::UNDER_REWRITE);
                        else
                            $choices = array(manuscriptPeer::REJECT, manuscriptPeer::PENDING);
                    break;
				}
				$this->form =  new manuscriptChangeStatusForm($this->manuscript, array('choices'=>$choices));
				$data = $request->getParameter('manuscript_change_status');
				break;
			case manuscriptPeer::ACCEPTED_REVIEW:
			case manuscriptPeer::REVIEWER_REFUSED:
            case manuscriptPeer::REVIEWER_REJECT:
				$this->form =  new manuscriptReviewerForm($this->manuscript);
				$data = $request->getParameter('manuscript_reviewer');
				break;
			case manuscriptPeer::UNDER_REVIEW:
				$this->form = new reviewProceedForm($this->manuscript);
				$data = $request->getParameter('proceed');
				break;
			case manuscriptPeer::REVIEW_FINAL:
                $this->form =  new manuscriptReviewForm($this->manuscript, array('status'=>$this->manuscript->getStatus()));
                $data = $request->getParameter('manuscript_review');
                break;
			case manuscriptPeer::PENDING:
				$publication = new Publication();
				$publication->setmanuscript($this->manuscript);
				$this->form = new PublicationForm($publication);
				$data = $request->getParameter('publication');
			default: break;
		}
		$this->form->bind($data);
		if (!$this->form->isValid())
		{
			$this->setTemplate('changeStatus');
			return;
		}
		if ($this->form->getName() == 'proceed' )
		{
			if (!$this->form->getValue('choice')) $this->redirect('@edit_review?manuscript_id='.$this->form->getValue('id').'&user_id='.$this->manuscript->getCurrentReviewer()->getId());
			else $this->redirect('@reject_review?manuscript_id='.$this->form->getValue('id').'&user_id='.$this->manuscript->getCurrentReviewer()->getId());
		}
		if ($this->form->getName() == 'manuscript_review' )
		{
            $review = reviewPeer::retrieveByPK($this->form->getValue('reviewer'), $this->form->getValue('manuscript'));
            if ($this->manuscript->getStatus() == manuscriptPeer::UNDER_REVIEW)
			     $this->redirect($this->generateUrl('edit_review', $review));
			else
			     $this->redirect($this->generateUrl('edit_review_final', $review));
						
		}
		/* @var $manuscript manuscript */
		if ($this->manuscript->getStatus() == manuscriptPeer::PENDING) $this->form->updateObject();
		$this->manuscript->setStatus($this->form->getValue('new_status'));
		switch ($this->manuscript->getStatus())
		{
			case manuscriptPeer::UNDER_REVIEW:
				$this->manuscript->addReviewerId($this->form->getValue('reviewer'));
				break;
			default: break;
		}
		$this->manuscript->save();
		if (sfConfig::get('app_mail_enabled'))
		{
		  //sfLoader::loadHelpers(array('Mail'));
		  //if ($this->manuscript->getStatus() == manuscriptPeer::REJECT) send_mail_reject($this->manuscript->getCorrespondingAuthor()->getEmail());
		  if (in_array ($this->manuscript->getStatus(),
		              array(manuscriptPeer::ACCEPTED_REVIEW,
		                    manuscriptPeer::PENDING,
		                    manuscriptPeer::REJECT,
		                    manuscriptPeer::UNDER_REWRITE )))
		          $this->sendMail($this->manuscript, $this->manuscript->getCorrespondingAuthor());
		  if ($this->manuscript->getStatus() == manuscriptPeer::UNDER_REVIEW)
		          $this->sendMail($this->manuscript, sfGuardUserProfilePeer::retrieveByPK($this->form->getValue('reviewer')));
		}
		$this->redirect('manuscript');
	}

	/**
	 * Redirect to manuscript info page
	 *
	 * Кнопка "подробно" в панели управления статьями
	 */
	public function executeInfo (sfWebRequest $request)
	{
		$this->redirect('@manuscript_info?id='.$request->getParameter('id'));
		//$this->manuscript = manuscriptPeer::retrieveByPK($request->getParameter('id'));
	}
			
    /**
     * Reloads default "new" action.
     *
     * Вместо предусмотренной админ генератором формы кнопка "создать" внизу страницы
     * ведёт к странице создания рукописи (модуль paper)
     * @see submitSuccess.php
     */
    public function executeNew(sfWebRequest $request)
    {
        $this->redirect('@create_manuscript');
    }

    /**
     * Implements sorting by all fields
     *
     * Обеспечивает сортировку по всем полям, в том числе и подразумевающим отношение "многие-ко-многим"
     * и по последнему действию
     * @see manuscriptPeer::doSelectOrderByForeignFields
     *
     */
    protected function addSortCriteria($criteria)
    {
        if (array(null, null) == ($sort = $this->getSort()))
        {
            return;
        }

        // camelize lower case to be able to compare with BasePeer::TYPE_PHPNAME translate field name
        if ($sort[0] == 'corresponding_author')
              $column = 'order_corresp.'.strtoupper(sfGuardUserProfilePeer::translateFieldName(sfGuardUserProfilePeer::LAST_NAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME));
        elseif ($sort[0] == 'submitted')
              $column = 'order_submit.'.strtoupper(actionPeer::translateFieldName(actionPeer::DATETIME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME));
        elseif ($sort[0] == 'authors')
              $column = 'order_authors.'.strtoupper(sfGuardUserProfilePeer::translateFieldName(sfGuardUserProfilePeer::LAST_NAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME));
        elseif ($sort[0] == 'reviewer')
              $column = 'order_reviewer.'.strtoupper(sfGuardUserProfilePeer::translateFieldName(sfGuardUserProfilePeer::LAST_NAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME));
        elseif ($sort[0] == 'action')
        {
              $column = 'order_action.'.strtoupper(actionPeer::translateFieldName(actionPeer::DATETIME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME));
              $column = 'MAX('.$column.')';
        }
        elseif ($sort[0] == 'city')
        {
        	$column = cityPeer::NAME;
        }
        else
            $column = manuscriptPeer::translateFieldName(sfInflector::camelize(strtolower($sort[0])), BasePeer::TYPE_PHPNAME, BasePeer::TYPE_COLNAME);
        if ('asc' == $sort[1])
        {
            $criteria->addAscendingOrderByColumn($column);
        }
        else
        {
            $criteria->addDescendingOrderByColumn($column);
        }
    }

    /**
     * Handles mail sending
     *
     * Отправка почты
     * @todo перенести в модуль mail и переписать (class factory, вынести функционал из контроллера)
     */
    protected function sendMail ($manuscript, $to )
    {
    	switch ($manuscript->getStatus())
    	{
    		case manuscriptPeer::ACCEPTED_REVIEW: $template = 'mReceived'; break;
    		case manuscriptPeer::REJECT:          $template = 'mRejected'; break;
    		case manuscriptPeer::PENDING:         $template = 'mAccepted'; break;
    		case manuscriptPeer::UNDER_REVIEW:    $template = 'mReview';   break;
    		case manuscriptPeer::UNDER_REWRITE:   $template = 'mRewrite';  break;
    	}
    	$culture_current = sfContext::getInstance()->getI18N()->getCulture();
    	if (in_array($to->getCountry(), sfConfig::get('app_mail_ru_lang')))
    	   sfContext::getInstance()->getI18N()->setCulture('ru');
        else sfContext::getInstance()->getI18N()->setCulture('en');
    	$subject = sfContext::getInstance()->getI18N()->__('Manuscript').' '.sfContext::getInstance()->getI18N()->__($manuscript->getStatusString());
    	$body = $this->getPartial('mail/'.$template, array('to'=>$to, 'manuscript'=>$manuscript));
    	$attachments = array();
    	$html_attachments = array();
    	if (sfConfig::get('app_mail_to_admin')) $to_email = sfConfig::get('app_mail_admin');
        else
        {
        	if (!$to->getsfGuardUser()->getIsActive()) return;
            else { $to_email = $to->getEmail(); $cc_email = sfConfig::get('app_mail_admin');}
        }
    	if ($template == 'mReview')
    	{
    		$filename = $manuscript->getLastFilename();
    		if (!is_null($filename)) $attachments['manuscript'] = $filename;
    		$extra_filename = $manuscript->getLastExtraFilename();
            if (!is_null($extra_filename)) $attachments['supplement'] = $extra_filename;
    	}
    	if ($template == 'mRewrite')
    	{
    		$review = $manuscript->getLastReview();
//    		$html_attachments['review1'] = get_partial('reviewer/form', array('form' => new reviewSubmitForm($review), 'disabled'=>true));
            $html_attachments['review1'] = get_partial('mail/mReviewForm', array('review' => $review));
    		$html_attachments['review1'] = '<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/></head>'.$html_attachments['review1'];
    		$filename = $review->getFilename();
            if (!is_null($filename)) $attachments['review1'] = $filename;
    	}
        if ($template == 'mRejected')
        {
            $review = $manuscript->getLastReview();
            if (!is_null($review))
            {
                $html_attachments['review'] = get_partial('mail/mReviewForm', array('review' => $review));
                $html_attachments['review'] = '<head><meta content="text/html; charset=utf-8" http-equiv="Content-Type"/></head>'.$html_attachments['review'];
                $filename = $review->getFilename();
                if (!is_null($filename)) $attachments['review'] = $filename;
            }
        }
    	sfProjectConfiguration::getActive()->loadHelpers('Mail');
    	send_mail($subject, $body, $attachments, $to_email, $cc_email, 'text/html', $html_attachments);
        sfContext::getInstance()->getI18N()->setCulture($culture_current);
    }
    
}
