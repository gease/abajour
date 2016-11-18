<?php
class paperFilter extends sfFilter
{
    public function execute($filterChain)
    {
       $request = $this->getContext()->getRequest();
       $user = $this->getContext()->getUser();
       if (!$user->isAuthenticated() || $user->hasCredential('admin'))
       {
           $filterChain->execute();
           return ;
       }
       else
       {
       	  $user_id = $request->getParameter('user_id');
       	  $manuscript_id = $request->getParameter('id');
       	  $profile = sfGuardUserPeer::retrieveByPK($user_id);
       	  if (isset($user_id) && $user->getGuardUser()->getId() != $user_id)
       	  {
       	  	 $this->getContext()->getController()->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
             throw new sfStopException();
       	  }
          if (!is_null($manuscript_id))
          {
            $manuscript = manuscriptPeer::retrieveByPK($manuscript_id);
            if ( $manuscript->isAuthor($user->getGuardUser()->getProfile()) ||
                 $manuscript->isReviewer($user->getGuardUser()->getProfile()))
            {
                $filterChain->execute();
                return;
            }
            else
            {
                $this->getContext()->getController()->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
                throw new sfStopException();
            }
          }
          else
          {
          	 $filterChain->execute();
             return;
          }
       }
    }
}