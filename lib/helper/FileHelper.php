<?php
function show_file($filepath)
{
	$response = sfContext::getInstance()->getResponse();
	$finfo = finfo_open( FILEINFO_MIME);
    $mimeType = finfo_file( $finfo, $filepath );
    //$mimeType = mime_content_type( $filepath );
    finfo_close( $finfo );
    if (in_array($mimeType, array('application/zip', 'application/x-zip', 'application/x-zip-compressed')))
    {
    	$pathinfo = pathinfo($filepath);
    	if ($pathinfo['extension'] == 'docx') $mimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    }
    $response->setContentType($mimeType);
    $response->setContent(file_get_contents($filepath));
}
?>