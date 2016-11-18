<?php

/**
 * RenderFormHelper.
 *
 * @package    magazine
 * @subpackage helper
 * @author     Vadim Valuev <gease@mail.ru>
 */

/**
 * Вывод формы, замена sfWidgetFormSchemaFormatter, т.к. в него
 * сложно передать всё что нужно
 * Отмечает обязательные поля, выводит ошибки
 *
 * @param sfForm $form
 * @return string HTML for the form
 */
function mark_required (sfForm $form)
{
    $ret = '';
    if ($form->hasGlobalErrors()) $ret.=$form->renderGlobalErrors();
    $ret .= '<ul>';
    foreach ($form as $name=>$field)
    {
    	$ret .= show_field($form, $name);
    }
    $ret .= '</ul>';
    return $ret;
}

/**
 * Вывод форматированного поля, вызывается из mark_required
 * или самостоятельно
 *
 * @param sfForm $form
 * @param string $name поле формы
 * @return string HTML
 */
function show_field (sfForm $form, $name)
{
        $ret='';
        $field = $form[$name];
        if ($field->isHidden()) continue;
        $class = '';
        $validatorSchema = $form->getValidatorSchema();
        if ($validatorSchema[$name]->getOption('required'))
        $class .='required ';
        if ($field->hasError()) $class .= 'error ';
        $ret .= '<li';
        if (trim($class)!='') $ret .= ' class="'.$class.'"';
        $ret .= '>';
        if ($field->hasError()) $ret .=  __($field->renderError());
        $ret .= $field->renderLabel();
        if ($field->getWidget() instanceof sfWidgetFormDate)
        $ret .= '<div class="widget_date">'.$field->render().'</div>';
        else $ret .= $field->render();
        $ret .= show_help($form, $name);
        $ret .= '</li>';
        return $ret;
}

/**
 * Форматированная помощь, позволяет включать в строку параметры
 *
 * @param sfForm $form
 * @param string $name поле формы
 * @return string HTML
 */
function show_help (sfForm $form, $name)
{
	$ret = '';
    $help = $form->getWidgetSchema()->getHelp($name);
    $field = $form[$name];
    if (!empty($help))
    {
        if (is_array($help))
        {
            $help_rend = __($help[0], $help[1]);
        }
        else
            /*if ( !is_null($field->renderHelp()) && trim($field->renderHelp())!='')*/
        {
            $help_rend = $field->renderHelp();
        }
        $ret .= '<div class="help_sign"></div>';
        $ret .= '<span class="help">'.$help_rend.'</span>';
    }
    return $ret;
}

/**
 * Выводит встроенную форму независимо (имя) от основной
 *
 * @param sfForm $form
 * @param string $name имя встроенной формы
 * @return string HTML
 */
function show_embedded_form (sfForm $form, $name)
{
	$e_forms = $form->getEmbeddedForms();
	$e_form = $e_forms[$name];
	/* @var $e_form sfForm */
	if (!isset($e_form)) throw new sfException('No such embedded form name');
	$ret = '';
	foreach ($e_form as $name=>$field)
	{
	   $ret .= $field->renderRow(array('size'=>15));
	}
	return $ret;
}

/**
 * Удобоваримый список допустимых форматов
 * @todo доделать
 * @param $extra bool относится ли собственно к статье или к допольнительному архиву
 * @return string
 */
function show_file_formats ($extra=false)
{
	static $extensions = array (
      'application/excel' => 'xls',
      'application/msword' => 'doc',
      'application/pdf' => 'pdf',
      'application/x-pdf' => 'pdf',
      'application/postscript' => 'ps',
      'application/presentations' => 'shw',
      'application/rtf' => 'rtf',
      'application/vnd.kde.kword' => 'kwd',
      'application/vnd.ms-excel' => 'xls',
      'application/vnd.ms-excel.sheet.macroEnabled.12' => 'xlsm',
      'application/vnd.ms-powerpoint' => 'ppt',
      'application/vnd.oasis.opendocument.text' => 'odt',
      'application/vnd.oasis.opendocument.text-template' => 'ott',
      'application/vnd.oasis.opendocument.text-web' => 'oth',
      'application/vnd.oasis.opendocument.text-master' => 'odm',
      'application/vnd.oasis.opendocument.graphics' => 'odg',
      'application/vnd.oasis.opendocument.graphics-template' => 'otg',
      'application/vnd.oasis.opendocument.presentation' => 'odp',
      'application/vnd.oasis.opendocument.presentation-template' => 'otp',
      'application/vnd.oasis.opendocument.spreadsheet' => 'ods',
      'application/vnd.oasis.opendocument.spreadsheet-template' => 'ots',
      'application/vnd.oasis.opendocument.chart' => 'odc',
      'application/vnd.oasis.opendocument.formula' => 'odf',
      'application/vnd.oasis.opendocument.database' => 'odb',
      'application/vnd.oasis.opendocument.image' => 'odi',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'docx',
      'application/vnd.openxmlformats-officedocument.wordprocessingml.template' => 'dotx',
      'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'xlsx',
      'application/vnd.openxmlformats-officedocument.presentationml.presentation' => 'pptx',
      'application/vnd.quark.quarkxpress' => 'qxd',
      'application/vnd.sealed.doc' => 'sdoc',
      'application/vnd.sealed.eml' => 'seml',
      'application/vnd.sealed.mht' => 'smht',
      'application/vnd.sealed.ppt' => 'sppt',
      'application/vnd.sealed.xls' => 'sxls',
      'application/vnd.sealedmedia.softseal.html' => 'stml',
      'application/vnd.sealedmedia.softseal.pdf' => 'spdf',
      'application/vnd.seemail' => 'see',
      'application/vnd.visio' => 'vsd',
      'application/vnd.wordperfect' => 'wpd',
      'application/vnd.wqd' => 'wqd',
      'application/wordperfect5.1' => 'wp5',
      'application/x-bzip2' => 'bz2',
      'application/x-gtar' => 'gtar',
      'application/x-gzip' => 'gz',
      'application/x-latex' => 'latex',
      'application/x-msexcel' => 'xls',
      'application/x-msword' => 'doc',
      'application/x-rar-compressed' => 'rar',
      'application/x-tar' => 'tar',
      'application/x-wordperfect6.1' => 'wp6',
      'application/x-zip' => 'zip',
      'application/x-zip-compressed' => 'zip',
	  'application/x-compressed' => 'zip',
      'application/zip' => 'zip',
      'image/bmp' => 'bmp',
      'image/gif' => 'gif',
      'image/jpeg' => 'jpg',
      'image/pjpeg' => 'jpg',
      'image/png' => 'png',
      'image/x-png' => 'png',
      'text/comma-separated-values' => 'csv',
      'text/html' => 'html',
      'text/plain' => 'txt',
      'text/richtext' => 'rtx',
      'text/rtf' => 'rtf',
     );
	if (!$extra) $file_formats = sfConfig::get('app_file_mime');
	else $file_formats = sfConfig::get('app_file_archive_mime');
	$file_formats = array_intersect_key($extensions, array_flip($file_formats));
	$file_formats = array_values($file_formats);
	$file_formats = array_unique($file_formats);
	$ret = '';
	foreach ($file_formats as $f) $ret .= $f.' ';
	return $ret;
}