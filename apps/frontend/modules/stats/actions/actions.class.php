<?php

/**
 * stats actions.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 160 2009-06-18 19:33:01Z я $
 */
class statsActions extends sfActions
{
 /**
  * Executes index action
  *
  * Единственная страница в модуле
  * @todo переписать, убрать всю логикув модель
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form = new statsForm();
    $this->totals = array();
    $this->regions = array();
    if (is_null($data = $request->getGetParameter('stats'))) return;
    $this->form->bind($data);
    if (!$this->form->isValid()) return;
    $values = $this->form->getValue('date_range');
    $this->totals = manuscriptPeer::getStatsForTimespan($values['from'], $values['to']);
    $c = new Criteria();
    $regions = RegionPeer::doSelectWithI18n($c);
    foreach ($regions as $region)
    {
    	$c->clear();
    	$c->add(cityPeer::REGION_ID, $region->getId());
    	$c->addJoin(manuscriptPeer::CITY_ID, cityPeer::ID);
    	$this->regions[$region->getName()] = manuscriptPeer::getStatsForTimespan($values['from'], $values['to'], $c);
    }
    //ages
    $c = new Criteria();
    $c->addJoin(manuscriptPeer::ID, userManuscriptRefPeer::MANUSCRIPT_ID);
    $c->addJoin(userManuscriptRefPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->addJoin(actionPeer::MANUSCRIPT_ID, manuscriptPeer::ID);
    $c->add(actionPeer::STATUS_AFTER, manuscriptPeer::SUBMITTED);
    if (!is_null($values['from']))
        {
            $c->add(actionPeer::DATETIME, $values['from'], Criteria::GREATER_EQUAL );
        }
        if (!is_null($values['to']))
        {
            $c->addAnd(actionPeer::DATETIME, $values['to'], Criteria::LESS_EQUAL );
        }
    $c->addAsColumn('age','timestampdiff(YEAR,'.sfGuardUserProfilePeer::BIRTHDAY.','.actionPeer::DATETIME.')');
    $lower = 0;
    $this->ages = array();
    foreach (sfConfig::get('app_age_split') as $limit)
    {
    	$c1 = clone($c);
    	$cton = $c1->getNewCriterion('age', $lower, Criteria::GREATER_EQUAL);
        $cton1 = $c1->getNewCriterion('age', $limit, Criteria::LESS_THAN);
        $cton->addAnd($cton1);
        $c1->addHaving($cton);
        $r = BasePeer::doCount($c1);
        $row = $r->fetch(PDO::FETCH_NUM);
        $this->ages[] = $row[0];
        $lower  = $limit;
    }
    $cton = $c->getNewCriterion('age', $lower, Criteria::GREATER_EQUAL);
    $c->addHaving($cton);
    $r = BasePeer::doCount($c);
    $row = $r->fetch(PDO::FETCH_NUM);
    $this->ages[] = $row[0];
    //number of papers per author
    $this->numbers = array();
    $c = new Criteria();
    $c->addJoin(manuscriptPeer::ID, userManuscriptRefPeer::MANUSCRIPT_ID);
    $c->addJoin(userManuscriptRefPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->addJoin(actionPeer::MANUSCRIPT_ID, manuscriptPeer::ID);
    $c->add(actionPeer::STATUS_AFTER, manuscriptPeer::SUBMITTED);
    if (!is_null($values['from']))
    {
        $c->add(actionPeer::DATETIME, $values['from'], Criteria::GREATER_EQUAL );
    }
    if (!is_null($values['to']))
    {
        $c->addAnd(actionPeer::DATETIME, $values['to'], Criteria::LESS_EQUAL );
    }
    $c->addAsColumn('n', 'COUNT(*)');
    $c->addGroupByColumn(sfGuardUserProfilePeer::USER_ID);
    $c1 = clone ($c);
    $cton = $c1->getNewCriterion('n', 1, Criteria::EQUAL);
    $c1->addHaving($cton);
    $r = BasePeer::doCount($c1);
    $row = $r->fetch(PDO::FETCH_NUM);
    $this->numbers[] = $row[0];
    $c1 = clone ($c);
    $cton = $c1->getNewCriterion('n', 2, Criteria::EQUAL);
    $c1->addHaving($cton);
    $r = BasePeer::doCount($c1);
    $row = $r->fetch(PDO::FETCH_NUM);
    $this->numbers[] = $row[0];
    $c1 = clone ($c);
    $cton = $c1->getNewCriterion('n', 2, Criteria::GREATER_THAN);
    $c1->addHaving($cton);
    $r = BasePeer::doCount($c1);
    $row = $r->fetch(PDO::FETCH_NUM);
    $this->numbers[] = $row[0];
    //new and returning authors
    $this->return = array();
    if (is_null($values['from'])) return;
    $c = new Criteria();
    $c->addJoin(manuscriptPeer::ID, userManuscriptRefPeer::MANUSCRIPT_ID);
    $c->addJoin(userManuscriptRefPeer::USER_ID, sfGuardUserProfilePeer::USER_ID);
    $c->addJoin(actionPeer::MANUSCRIPT_ID, manuscriptPeer::ID);
    $c->add(actionPeer::STATUS_AFTER, manuscriptPeer::SUBMITTED);
    if (!is_null($values['from']))
    {
        $c->add(actionPeer::DATETIME, $values['from'], Criteria::GREATER_EQUAL );
    }
    if (!is_null($values['to']))
    {
        $c->addAnd(actionPeer::DATETIME, $values['to'], Criteria::LESS_EQUAL );
    }
    $c->addAlias('m', manuscriptPeer::TABLE_NAME);
    $c->addAlias('u', userManuscriptRefPeer::TABLE_NAME);
    $c->addAlias('a', actionPeer::TABLE_NAME);
    $c->addJoin('m.ID', 'u.MANUSCRIPT_ID');
    $c->addJoin('u.USER_ID', sfGuardUserProfilePeer::USER_ID);
    $c->addJoin('a.MANUSCRIPT_ID', 'm.ID');
    $c->add('a.STATUS_AFTER', manuscriptPeer::SUBMITTED);
    $c->add('a.DATETIME', $values['from'], Criteria::LESS_EQUAL);
    $c->addSelectColumn(userManuscriptRefPeer::USER_ID);
    $c->setDistinct();
    $r = BasePeer::doCount($c);
    $row = $r->fetch(PDO::FETCH_NUM);
    $this->return[] = $row[0];
    $c->add('m.STATUS', array( manuscriptPeer::PUBLISHED, manuscriptPeer::ACCEPTED_PUBL, manuscriptPeer::PENDING),  Criteria::IN);
    $r = BasePeer::doCount($c);
    $row = $r->fetch(PDO::FETCH_NUM);
    $this->return[] = $row[0];
  }
}
