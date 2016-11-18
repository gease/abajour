<?php

/**
 * GuardUser form.
 *
 * @package    magazine
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: GuardUserForm.class.php 141 2009-06-07 13:19:26Z я $
 */
class GuardUserForm extends BaseGuardUserForm
{
  public function configure()
  {
  	$this->widgetSchema['birthday'] = new myBirthdayWidget();
  	$this->widgetSchema['country'] = new sfWidgetFormI18nSelectCountry(array('culture'=>sfContext::getInstance()->getUser()->getCulture()));
  }
}
