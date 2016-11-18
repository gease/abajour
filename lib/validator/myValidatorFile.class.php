<?php

/**
 * Overrides getMimeType in order to handle docx
 * @version    SVN: $Id $
 */
class myValidatorFile extends sfValidatorFile
{
  protected function getMimeType($file, $fallback)
  {
  	
    foreach ($this->getOption('mime_type_guessers') as $method)
    {
      $type = call_user_func($method, $file);

      if (!is_null($type) && $type !== false)
      {
        break;
      }
    }
    if ($fallback == 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        && in_array($type, array('application/zip', 'application/x-zip', 'application/x-zip-compressed')))
        return $fallback;
    if (is_null($type) || $type == false) return $fallback;
    return $type;
  }
}
?>