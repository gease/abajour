<?php

/**
 * reviewer actions.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 169 2009-10-11 19:10:38Z я $
 */
class reviewerActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  /**
   * Submit review
   *
   * Теоретически, позволяет редактировать содержание имеющейся рецензии,
   * но, при нынешней логике, используется только для создания новых
   */
  public function executeEdit (sfWebRequest $request)
  {
    $this->object = $this->getRoute()->getObject();
    $this->form = reviewPeer::getForm($this->object);
    $this->setTemplate('submit');
  }

  /**
   * Final decision form
   *
   * Для статьи, побывавшей на переработке и вернувшейся к рецензенту
   * - окончательное решение
   */
  public function executeEditFinal (sfWebRequest $request)
  {
  	$this->object = $this->getRoute()->getObject();
    $this->form = new reviewForm($this->object);
  }
  
  /**
   * Review form processing
   *
   * @todo вынести почту и сохранение файла
   */
  public function executeSubmit(sfWebRequest $request)
  {
        $this->object = $this->getRoute()->getObject();
  		$data = $request->getPostParameter('submit_review');
  		$files = $request->getFiles('submit_review');
  		$this->form = reviewPeer::getForm($this->object);
  		$this->form->bind($data, $files);
  		if (!$this->form->isValid()) return;
  		$review = $this->form->updateObject();
  		if (!$review->equals($this->object)) return; //если изменены скрытые поля формы
  		$review->getmanuscript()->setStatus(manuscriptPeer::AFTER_REVIEW);
  		$review->save();
  		if ($file = $this->form->getValue('file'))
  		{
  			$i = 0;
            do
	        {
	           $filename =  'r_'.$review->getManuscriptId().'_'.$review->getUserId().'_'.$i;
               $files = sfFinder::type('file')->name($filename.'.*')->in(sfConfig::get('sf_upload_dir'));
               $i++;
            } while ($files);
            $extension = $file->getExtension($file->getOriginalExtension());
            $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
  		}
        if (sfConfig::get('app_mail_enabled'))
        {
            sfProjectConfiguration::getActive()->loadHelpers('Mail');
            send_mail('Новая рецензия', sprintf("Поступила рецензия на статью %s авторов %s", $review->getmanuscript()
              ->getTitle(), $this->getPartial('manuscript/authors', array('manuscript' => $review->getmanuscript()))), array(), sfConfig::get('app_mail_admin'), NULL, 'text/html'
            );
        }
  		$this->redirect(array(
  		    'sf_route' => 'list_reviews',
  		    'user_id' =>  $this->form->getValue('user_id')
  		));
  }

  /**
   * Final reviewer's decision processing
   *
   * @see self::executeEditFinal()
   */
  public function executeSubmitFinal (sfWebRequest $request)
  {
        $this->object = $this->getRoute()->getObject();
        $data = $request->getPostParameter('review');
        $files = $request->getFiles('review');
        $this->form = new reviewForm($this->object);
        $this->form->bind($data, $files);
        if (!$this->form->isValid()) return;
        $review = $this->form->updateObject();
        if (!$review->equals($this->object)) return;
        $review->getmanuscript()->setStatus(manuscriptPeer::AFTER_REVIEW);
        $review->save();
        if ($file = $this->form->getValue('file'))
        {
            $i = 0;
            do
            {
               $filename =  'r_'.$review->getManuscriptId().'_'.$review->getUserId().'_'.$i;
               $files = sfFinder::type('file')->name($filename.'.*')->in(sfConfig::get('sf_upload_dir'));
               $i++;
            } while ($files);
            $extension = $file->getExtension($file->getOriginalExtension());
            $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);
        }
        $this->redirect(array(
            'sf_route' => 'list_reviews',
            'user_id' =>  $this->form->getValue('user_id')
        ));
  }
  
  /**
   * Reviewer refuses to review a manuscript
   */
  public function executeReject(sfWebRequest $request)
  {
  	$review = $this->getRoute()->getObject();
  	$review->getmanuscript()->setStatus(manuscriptPeer::REVIEWER_REFUSED);
  	$review->setOutcome(reviewPeer::REFUSED_REVIEW);
  	$review->save();
    if (sfConfig::get('app_mail_enabled'))
    {
        sfProjectConfiguration::getActive()->loadHelpers('Mail');
        send_mail('Новая рецензия', sprintf("Рецензент %s отказался рецензировать статью %s авторов %s",
          $review->getsfGuardUserProfile(),
          $review->getmanuscript()->getTitle(),
          $this->getPartial('manuscript/authors', array('manuscript' => $review->getmanuscript()))), array(), sfConfig::get('app_mail_admin'), NULL, 'text/html'
        );
    }
  	$this->redirect('@user?user_id='.$review->getUserId());
  }

  /**
   * View review, wit no possibility to edit or submit
   */
  public function executeView(sfWebRequest $request)
  {
    $this->review = $this->getRoute()->getObject();
//    $this->reviewContents = unserialize($review->getContents());
    $this->form = reviewPeer::getForm($this->review);
  }

 /**
  * File attached to review, if any
  */
  public function executeLinkFile(sfWebRequest $request)
  {
    $filepath = $this->getRoute()->getObject()->getFilename();
    if ($filepath == null) $this->redirect404();
    sfProjectConfiguration::getActive()->loadHelpers('File');
    show_file($filepath);
    return sfView::NONE;
  }
   
}
