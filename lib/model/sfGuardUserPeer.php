<?php
class sfGuardUserPeer extends PluginsfGuardUserPeer
{
  public static function retrieveByUsername($username, $isActive = null)
  {
    $c = new Criteria();
    $c->add(self::USERNAME, $username);
    if ($isActive !== null)
    $c->add(self::IS_ACTIVE, $isActive);

    return self::doSelectOne($c);
  }
	
}
