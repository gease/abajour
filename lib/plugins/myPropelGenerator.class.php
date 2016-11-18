<?php
/**
 * myPropelGenerator extends sfPropelGenerator
 * in order to translate 'confirm' option of arbitrary action
 * like it is done in sfPropelAdminGenerator
 */
class myPropelGenerator extends sfPropelGenerator
{
  public function getLinkToAction($actionName, $params, $pk_link = false)
  {
  	$ret_val = parent::getLinkToAction($actionName, $params, $pk_link);
  	$ret_val = preg_replace("/'confirm' => '(.+?)(?<!\\\)'/", '\'confirm\' => __(\'$1\')', $ret_val);
  	return $ret_val;
  }
}
?>