<?php
require_once __DIR__ . '/../vendor/swift/swift_required.php';

/**
 *
 * @param string $subject
 * @param string $body
 * @param array $attachments
 * @param string $to
 * @param array | string $cc
 * @param string $format
 * @param array  $html_attachments
 */
function send_mail ($subject, $body, $attachments, $to, $cc, $format = 'text', $html_attachments = array())
{
	try
	{
	// Create the mailer and message objects
		$smtp = Swift_SmtpTransport::newInstance(sfConfig::get('app_mail_server'))
		  ->setUsername(sfConfig::get('app_mail_login'))
		  ->setPassword(sfConfig::get('app_mail_password'));
    if (sfConfig::get('app_mail_port')) {
      $smtp->setPort(sfConfig::get('app_mail_port'));
    }
    if (sfConfig::get('app_mail_encryption')) {
    	$smtp->setEncryption(sfConfig::get('app_mail_encryption'));
		}
		$mailer = new Swift_Mailer($smtp);
    if (sfConfig::get('app_mail_to_admin')) {
      $to = sfConfig::get('app_mail_admin');
    }
    /* @var $message Swift_Message */
    $message = Swift_Message::newInstance($subject)
      ->setFrom(array(sfConfig::get('app_mail_from')))
      ->setTo(array($to))
      ->setBody($body);
    if (!empty($cc)) {
      if (is_array($cc)) {
        $message->setCc($cc);
      }
      else {
        $message->addCc($cc);
      }
    }
    if ($to != sfConfig::get('app_mail_admin')) {
      $message->addBcc(sfConfig::get('app_mail_admin'));
    }
    if ($format == 'html' || !empty($html_attachments)) {
      $message->setContentType('text/html');
    }
    if ($format == 'html') {
      $message->addPart(strip_tags($body));
    }
    foreach ($html_attachments as $name=>$contents) {
      $message->attach(Swift_Attachment::newInstance($contents, $name . ".html", 'text/html')->setDisposition('inline'));
    }
		foreach ($attachments as $name=>$file)
		{
		  $ext = pathinfo($file, PATHINFO_EXTENSION);
			$message->attach(Swift_Attachment::fromPath($file)->setFilename($name . '.' . $ext));
		}
		// Send
    if (sfConfig::get('app_mail_enabled')) {
      $mailer->send($message, $failures);
      if (sfConfig::get('sf_logging_enabled'))
      {
        sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent('MailHelper', 'application.log', array(
          sprintf('mail %s was sent to %s with cc to %s and bcc to %s',
            $message->getSubject(),
            implode(', ', array_keys($message->getTo())),
            implode(', ', array_keys($message->getCc())),
            implode(', ', array_keys($message->getBcc()))
          )
        )));
        if (!empty($failures)) {
          sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent('MailHelper', 'application.log', array(
            'message' => sprintf('mail was not delivered to the following recipients: %s', implode(',', $failures)),
            'priority' => sfLogger::WARNING
          )));
        }
      }
    }
    else {
      if (sfConfig::get('sf_logging_enabled')) {
        sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent('MailHelper', 'application.log', array(
          'message' => $message->toString(),
          'priority' => sfLogger::DEBUG
        )));
      }
    }
	}
	catch (Exception $e)
	{
	  if (sfConfig::get('sf_logging_enabled')) {
	    sfContext::getInstance()->getEventDispatcher()->notify(new sfEvent('MailHelper', 'application.log', array(
	      'message' => 'sending mail failed: %s', $e->getMessage(),
        'priority' => sfLogger::ERR
        )
      ));
    }
		sfContext::getInstance()->getUser()->setFlash('error', 'Sending mail failed.');
	}
}
?>
