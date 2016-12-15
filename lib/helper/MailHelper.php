<?php
require_once(sfConfig::get('sf_vendor_dir').'/swift/Swift.php');
require_once(sfConfig::get('sf_vendor_dir').'/swift/Swift/Connection/SMTP.php');

/**
 *
 * @param unknown_type $subject
 * @param unknown_type $body
 * @param unknown_type $attachments
 * @param unknown_type $to
 * @param unknown_type $cc
 * @param unknown_type $from
 * @param unknown_type $format
 * @param unknown_type $html_attachments
 */
function send_mail ($subject, $body, $attachments, $to, $cc, $from, $format = 'text/plain', $html_attachments = array())
{
	try
	{
	// Create the mailer and message objects
		$smtp = new Swift_Connection_SMTP(sfConfig::get('app_mail_server'));
		$smtp->setUsername(sfConfig::get('app_mail_login'));
		$smtp->setPassword(sfConfig::get('app_mail_password'));
    if (sfConfig::get('app_mail_secure')) {
      $smtp->setPort($smtp::PORT_SECURE);
      $smtp->setEncryption($smtp::ENC_TLS);
    }
    if (sfConfig::get('app_mail_custom_port')) {
    	$smtp->setPort(sfConfig::get('app_mail_custom_port'));
		}
		$mailer = new Swift($smtp);
		if (empty($attachments) && empty($html_attachments))
			$message = new Swift_Message($subject, $body, $format);
		else
		{
			$message = new Swift_Message($subject);
			$message->attach(new Swift_Message_Part($body, $format));
		}
		$recipients = new Swift_RecipientList();
		$recipients->addTo($to);
		if (!empty($cc)) $recipients->addCc($cc);
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
			$message->attach(new Swift_Message_Attachment(
        	   new Swift_File($file), $name.$ext, $mimeType));
		}
		foreach ($html_attachments as $name=>$contents)
		{
			$message->attach(new Swift_Message_Attachment($contents, $name, 'text/html'));
		}
		// Send
		$mailer->send($message, $recipients, $from);
		$mailer->disconnect();
	}
	catch (Exception $e)
	{
		if ($mailer) $mailer->disconnect();
		sfContext::getInstance()->getLogger()->err(sprintf('sending mail failed: %s', $e->getMessage()));
		sfContext::getInstance()->getUser()->setFlash('error', 'Sending mail failed.');
	}
}
?>
