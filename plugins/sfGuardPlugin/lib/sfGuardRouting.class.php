<?php

/*
 * This file is part of the symfony package.
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardRouting.class.php 12071 2008-10-08 12:31:20Z fabien $
 */
class sfGuardRouting
{
  /**
   * Listens to the routing.load_configuration event.
   *
   * @param sfEvent An sfEvent instance
   */
  static public function listenToRoutingLoadConfigurationEvent(sfEvent $event)
  {
    $r = $event->getSubject();

    // preprend our routes
    $r->prependRoute('sf_guard_signin', new sfRoute('/login', array('module' => 'sfGuardAuth', 'action' => 'signin')));
    $r->prependRoute('sf_guard_signout', new sfRoute('/logout', array('module' => 'sfGuardAuth', 'action' => 'signout')));
    $r->prependRoute('sf_guard_password', new sfRoute('/request_password', array('module' => 'sfGuardAuth', 'action' => 'password')));
  }
}
