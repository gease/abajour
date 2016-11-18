<?php

class myUser extends sfGuardSecurityUser
{
  public function getReferer($default)
  {
    $referer = $this->getAttribute('referer', $default);
    if (trim($referer) == '') $referer = $default;
    $this->getAttributeHolder()->remove('referer');
    return $referer;
  }
}
