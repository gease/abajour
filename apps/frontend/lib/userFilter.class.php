<?php

class userFilter extends sfFilter
{
	public function execute($filterChain)
	{
	   $request = $this->getContext()->getRequest();
	   $user = $this->getContext()->getUser();
	   if (!$user->isAuthenticated())
	   {
	       $filterChain->execute();
	   }
	   else
	   {
		  if (!is_null($request->getParameter('user_id')) && $request->getParameter('user_id') != $user->getGuardUser()->getId())
		  {
			 if ($user->hasCredential('admin'))
			 {
			   	$filterChain->execute();
			 }
			 else
			 {
			        $this->getContext()->getController()->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
			        throw new sfStopException();
			 }
		  }
		  else
		  {
		      $request->addRequestParameters(array('user_id'=>$user->getGuardUser()->getId()));
		      $filterChain->execute();
		  }
	   }
	   $filterChain->execute();
	}
}