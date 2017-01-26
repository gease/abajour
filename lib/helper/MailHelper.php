<?php
require_once __DIR__ . '/../vendor/swift/swift_required.php';

/**
 *
 * @param unknown_type $subject
 * @param unknown_type $body
 * @param unknown_type $attachments
 * @param unknown_type $to
 * @param unknown_type $cc
 * @param string|\unknown_type $format
 * @param array|\unknown_type $html_attachments
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
			$ext = substr($file, strrpos($file, '.'));
			$finfo = finfo_open( FILEINFO_MIME );
			$mimeType = finfo_file( $finfo, $file );
			finfo_close( $finfo );
			if (in_array($mimeType, array('application/zip', 'application/x-zip', 'application/x-zip-compressed')))
			{
				if ($ext == 'docx') $mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
			}
			$message->attach(Swift_Attachment::fromPath($file), $mimeType);
		}
		// Send
    if (sfConfig::get('app_mail_enabled')) {
      $mailer->send($message, $failures);
      if (!empty($failures)) {
        sfContext::getInstance()->getLogger()->warning(sprintf('mail was not delivered to the following recipients: %s', implode(',', $failures)));
      }
    }
    else {
      sfContext::getInstance()->getLogger()->debug($message->toString());
    }

	}
	catch (Exception $e)
	{
		sfContext::getInstance()->getLogger()->err(sprintf('sending mail failed: %s', $e->getMessage()));
		sfContext::getInstance()->getUser()->setFlash('error', 'Sending mail failed.');
	}
}
?>
