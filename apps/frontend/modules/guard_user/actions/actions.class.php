<?php

/**
 * guard_user actions.
 *
 * @package    magazine
 * @subpackage frontend
 * @author     Vadim Valuev
 * @version    SVN: $Id: actions.class.php 145 2009-06-07 19:42:23Z я $
 */

require_once dirname ( __FILE__ ) . '/../lib/guard_userGeneratorConfiguration.class.php';
require_once dirname ( __FILE__ ) . '/../lib/guard_userGeneratorHelper.class.php';

/**
 * guard_user actions.
 *
 * Модуль guard_user автоматически генерируется admin generator'ом
 * на основании MySQL view guard_user, соответственно, его классы и шаблоны
 * находятся в директории cache
 * Здесь переопределяются некоторые методы в связи с тем, что формы оперируют не с view guard_user,
 * а с таблицами sf_guard_user и sf_guard_user_profile
 * Обеспечивает управление пользователями в администраторской панели
 * @see .\..\config\generator.yml
 * @see cache/frontend/prod/modules/autoGuard_user/templates/_list_td_actions.php
 *
 */
class guard_userActions extends autoGuard_userActions {
	
    /**
	 * Promote user to reviewer
	 *
	 * Пользователь с id из запроса переводится в состояние "рецензент"
	 * Вызывается кнопкой "Сделать рецензентом" с панели управления пользователями
	 */
	public function executeSetReviewer(sfWebRequest $request) {
		$reviewer = sfGuardUserPeer::retrieveByPK ( $request->getParameter ( 'id' ) )->getProfile ();
		/* @var $reviewer sfGuardUserProfile */
		$reviewer->setIsReviewer ( true );
		$reviewer->save ();
		$this->redirect ( $request->getReferer () );
	}
	
	/**
	 *Demote user from reviewer
	 *
	 * Действие, обратное self::executeSetReviewer
	 */
	public function executeUnsetReviewer(sfWebRequest $request) {
		$reviewer = sfGuardUserPeer::retrieveByPK ( $request->getParameter ( 'id' ) )->getProfile ();
		/* @var $reviewer sfGuardUserProfile */
		$reviewer->setIsReviewer ( false );
		$reviewer->save ();
		$this->redirect ( $request->getReferer () );
	}
	
	/**
	 * Redirects to user's homepage
	 *
	 * Перенаправление с админской панели на страницу пользователя - кнопка "подробно"
	 */
	public function executeInfo(sfWebRequest $request) {
		//	$this->profile = sfGuardUserPeer::retrieveByPK($request->getParameter('id'))->getProfile();
		$this->redirect ( '@user?user_id=' . $request->getParameter ( 'id' ) );
	
	}
	
	/**
	 * Edit relevant sf_guard_user table entry
	 *
	 * Переход к изменеию записи в таблице sf_guard_user, кнопка "изменить учётную запись"
	 */
	public function executeEditGuard(sfWebRequest $request) {
		$this->guard_user = $this->getRoute ()->getObject ();
		$this->form = new guardAdminForm ( $this->guard_user->getsfGuardUser () );
		$this->setTemplate ( 'editGuard' );
	}
	
	/**
	 * Standard controller called by editGuard template
	 *
	 * Контроллер по образцу генерируемых админ генератором согласно
	 * правилам sfPropelRouteCollection
	 * @see editGuardSuccess.php
	 */
	public function executeUpdateGuard(sfWebRequest $request) {
		$this->form = new guardAdminForm ( );
		$form_data = $request->getParameter ( $this->form->getName () );
		$this->guard_user = sfGuardUserPeer::retrieveByPK ( $form_data ['id'] );
		if (! $this->guard_user)
			$this->redirect404 ();
		$this->form = new guardAdminForm ( $this->guard_user );
		$this->form->bind ( $form_data );
		if ($this->form->isValid ()) {
			$this->getUser ()->setFlash ( 'notice', $this->form->getObject ()->isNew () ? 'The item was created successfully.' : 'The item was updated successfully.' );
			
			$this->form->save ();
			$this->redirect ( '@guard_user' );
		
		} else {
			$this->getUser ()->setFlash ( 'error', 'The item has not been saved due to some errors.' );
		}
		$this->setTemplate ( 'editGuard' );
	}
	
	/**
	 * Reloads autoGuard_userActions::addSortCriteria
	 *
	 * Переопределяет метод родительского класса, добавляя возможность
	 * сортировать по названию города
	 *
	 * @param $criteria Criteria
	 */
	protected function addSortCriteria($criteria) {
		if (array (null, null ) == ($sort = $this->getSort ())) {
			return;
		}
		
		// camelize lower case to be able to compare with BasePeer::TYPE_PHPNAME translate field name
		if ($sort [0] == 'city_id') {
			$column = cityPeer::NAME;
		} else
			$column = GuardUserPeer::translateFieldName ( sfInflector::camelize ( strtolower ( $sort [0] ) ), BasePeer::TYPE_PHPNAME, BasePeer::TYPE_COLNAME );
		if ('asc' == $sort [1]) {
			$criteria->addAscendingOrderByColumn ( $column );
		} else {
			$criteria->addDescendingOrderByColumn ( $column );
		}
	}
}
