<?php

/**
 * Subclass for performing query and update operations on the 'sf_guard_user_profile' table.
 *
 *
 *
 * @package lib.model
 */
class sfGuardUserProfilePeer extends BasesfGuardUserProfilePeer
{
	
	/**
	 * select for authors autocompleter
	 *
	 * Для аяксовой подсказки в выборе соавтров для статьи
	 * Выбирает всех авторов, в чью фамилию входит запрос
	 * @see paperActions::executeAutocomplete()
	 */
	static public function retrieveForSelect($q, $limit = 150)
  	{
    	$criteria = new Criteria();
    	$criteria->add(sfGuardUserProfilePeer::LAST_NAME, '%'.$q.'%', Criteria::LIKE);
    	$criteria->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
    	$criteria->setLimit($limit);
 
//    	$authors = array();
//    	foreach (sfGuardUserProfilePeer::doSelectJoinsfGuardUser($criteria) as $author)
//    	{
//      		$authors[$author->getUserId()] = (string) $author;
//    	}
        $authors = sfGuardUserProfilePeer::doSelect($criteria);
    	return $authors;
  	}
  	
  	/**
  	 * Select by last name exactly
  	 *
  	 * Выбор точно по фамилии
  	 * @see userActions::executeCheckUsers()
  	 */
  	static public function retrieveByLastName($q, $limit = 20)
  	{
  		$criteria = new Criteria();
        $criteria->add(sfGuardUserProfilePeer::LAST_NAME, $q);
        $criteria->addAscendingOrderByColumn(sfGuardUserProfilePeer::LAST_NAME);
        $criteria->addAscendingOrderByColumn(sfGuardUserProfilePeer::FIRST_NAME);
        $criteria->setLimit($limit);
        $users = sfGuardUserProfilePeer::doSelect($criteria);
        return $users;
  	}

  	static public function doSelectReviewer (Criteria $c)
  	{
  		if ($c instanceof Criteria) $c = clone $c;
  		else $c = new Criteria();
  		
  		$c->add(self::IS_REVIEWER, true);
  		
  		return self::doSelectOne($c);
  	}
  	
}
