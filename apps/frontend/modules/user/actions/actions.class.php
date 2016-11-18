<?php

/**
 * user actions.
 *
 * Все действия, связанные с конкрентным пользователем и только с ним,
 * для которых достаточно в качестве ключа id пользователя - список статей, рецензий,
 * регистрация, управление личными данными
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 160 2009-06-18 19:33:01Z я $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->profile = $this->getRoute()->getObject();
  }
  
  public function executeListManuscripts(sfWebRequest $request)
  {
    /* @var $request sfWebRequest */

    $this->user = $this->getRoute()->getObject();
   }
  
  public function executeListReviews(sfWebRequest $request)
  {
  	$reviewer = $this->getRoute()->getObject();
  	$this->reviews = $reviewer->getreviewsJoinmanuscript();
  }
  
  
  public function executeRegister($request)
  {
  	/* @var $request sfWebRequest */
  	if ($this->getUser()->getGuardUser())
  	{
  		return $this->redirect('user/edit');
  	}
  	else
  	{
  		$this->userForm = new myUserForm();
  		$this->profileForm = new sfGuardUserProfileForm();
  		$this->captchaForm = new captchaForm();
  	}
  	if ($request->isMethod('post'))
  	{
  		$user_params = $request->getParameter('user');
  		$profile_params = $request->getParameter('sf_guard_user_profile');
  		$captcha_params = $request->getParameter('captcha');
  		$this->userForm->bind($user_params);
  		$this->profileForm->bind($profile_params);
  		$this->captchaForm->bind($captcha_params);
  		if ($this->userForm->isValid() && $this->profileForm->isValid() && $this->captchaForm->isValid())
  		{
  			$clean_user_values = $this->userForm->getValues();
  			$security_user = new sfGuardUser();
  			$security_user->setUsername($clean_user_values['username']);
  			$security_user->setPassword($clean_user_values['password']);
  			$security_user->save();
  			$clean_profile_values = $this->profileForm->getValues();
  			$profile = new sfGuardUserProfile();
  			$profile->setsfGuardUser($security_user);
  			foreach ($clean_profile_values as $key=>$value)
  			{
  				$profile->setByName($key, $value, BasePeer::TYPE_FIELDNAME);
  			}
  			$profile->save();
  			$this->getUser()->signIn($security_user);
  			$this->redirect('@user?user_id='.$security_user->getId());
  		}
  	}
  }
  
  public function executeEdit(sfWebRequest $request)
  {
  	//$security_user = $this->getUser()->getGuardUser();
  	$security_user = sfGuardUserPeer::retrieveByPK($request->getParameter('user_id'));
  	if ($security_user)
  	{
  		$this->userForm = new myUserForm(array('username'=>$security_user->getUsername()));
  		$this->profileForm = new sfGuardUserProfileForm($security_user->getsfGuardUserProfile());
  		$this->id = $request->getParameter('user_id');
  	}
  	else
  	{
  		return $this->redirect('user/register');
  	}
  	if ($request->isMethod('post'))
  	{
  		$user_params = $request->getParameter('user');
  		$profile_params = $request->getParameter('sf_guard_user_profile');
  		$this->userForm->bind($user_params);
  		$this->profileForm->bind($profile_params);
  		if ($this->userForm->isValid() && $this->profileForm->isValid())
  		{
  			$clean_user_values = $this->userForm->getValues();
  			$security_user->setUsername($clean_user_values['username']);
  			$security_user->setPassword($clean_user_values['password']);
  			$security_user->save();
  			$clean_profile_values = $this->profileForm->getValues();
  			$profile = $security_user->getsfGuardUserProfile();
  			if (is_null($profile))
  			{
  				$profile = new sfGuardUserProfile();
  				$profile->setsfGuardUser($security_user);
  			}
  			foreach ($clean_profile_values as $key=>$value)
  			{
  				$profile->setByName($key, $value, BasePeer::TYPE_FIELDNAME);
  			}
  			$profile->save();
  			$this->redirect('@user?user_id='.$request->getParameter('user_id'));
  		}
  	}
  }
  
  /**
   * Renders results for author autocomplete field
   *
   * Выбирает авторов, чьи фамили содержат в себе тескст запроса, и отсылает в формате, требуемом
   * плагином autocomplete.js
   * @see submitSuccess.php
   */
  public function executeAutocomplete(sfWebRequest $request)
  {
    if (!$request->isXmlHttpRequest()) $this->redirect404();
  	$authors = sfGuardUserProfilePeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));
 	$output = '';
// 	foreach ($authors as $key=>$value)
// 	{
// 		$output .= $key.'|'.$value."\n";
// 	}
//
    foreach ($authors as $author)
    {
        $output .= $author->getId().'|'.$author.'|'.$author->getInstitution()."\n";
    }
  	return $this->renderText($output);
  }
  
  /**
   * controller for ajax-checking if the user exists already in the system
   *
   * Выбирает авторов, чьи фамилии в точности совпадают с запросом, для проверки на странице регистрации
   * @see registerSuccess.php
   */
  public function executeCheckUsers(sfWebRequest $request)
  {
    if (!$request->isXmlHttpRequest()) $this->redirect404();
    $authors = sfGuardUserProfilePeer::retrieveByLastName($request->getParameter('q'), $request->getParameter('limit'));
//  foreach ($authors as $key=>$value)
//  {
//      $output .= $key.'|'.$value."\n";
//  }
//
    $authors_array = array();
    foreach ($authors as $author)
    {
    	$author_array = array();
    	$author_array['first_name']  = $author->getFirstName();
    	$author_array['last_name']   = $author->getLastName();
    	$author_array['middle_name'] = $author->getMiddleName();
    	$author_array['institution'] = $author->getInstitution();
        $authors_array[] = $author_array;
    }
    return $this->renderText(json_encode($authors_array));
  }
}
