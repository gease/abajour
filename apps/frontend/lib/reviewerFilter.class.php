<?php
class reviewerFilter extends sfFilter
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
          $manuscript_id = $request->getParameter('manuscript_id');
          $reviewer_id = $request->getParameter('user_id');
          $profile = $user->getGuardUser()->getProfile();
          $action = $this->getContext()->getActionName();
          $review = reviewPeer::retrieveByPK($reviewer_id, $manuscript_id);
          $manuscript = manuscriptPeer::retrieveByPK($manuscript_id);
          if (  ($reviewer_id == $profile->getId()) ||
                (($action == 'linkFile' || $action == 'view') && $manuscript->isAuthor($profile))
              )
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
  }
}