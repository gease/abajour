<?php

/**
 * main actions.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 146 2009-06-08 17:30:21Z я $
 */

/**
 * General actions, substituting for symfony "default" module
 *
 */
class mainActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

  public function executeIndex(sfWebRequest $request)
  {
  	if ($this->getUser()->hasCredential('admin')) $this->redirect('@manuscript');
  	if ($this->getUser()->isAuthenticated()) $this->redirect('@user?user_id='.$this->getUser()->getGuardUser()->getID());
  }
  
  public function executeChangeLanguage(sfWebRequest $request)
  {
    $this->form = new myFormLanguage($this->getUser(), array('languages' => array('en', 'ru')));
 
    if ($request->isMethod('post'))
    {
      $this->form->process($request);
      return $this->redirect($request->getReferer());
    }
    return $this->renderPartial('language');
  }
  
  public function executeError404 (sfWebRequest $request)
  {
  }
  
  public function executeDisabled (sfWebRequest $request)
  {
    return;
  }
}
