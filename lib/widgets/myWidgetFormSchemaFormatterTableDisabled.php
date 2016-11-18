<?php
/**
 * Форматер для просмотра поданных форм рецензии в табличном виде
 *  @version    SVN: $Id: myWidgetFormSchemaFormatterTableDisabled.php 167 2009-10-10 19:06:28Z я $
 */

class myWidgetFormSchemaFormatterTableDisabled extends sfWidgetFormSchemaFormatter
{
	protected
        $rowFormat          = "<tr>\n  <td>%label%</td>\n  <td>%field%%help%</td>\n</tr>\n",
        $helpFormat         = '<br />%help%',
        $decoratorFormat    = "<table>\n  %content%</table>",
        $multipleChoiceFormat = "<ul>%choices%</ul>",
        $choicesFormat      = "<li>%choice%</li>";
        
    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
        
    	//логика обработки полей
    	//файл - не показывать
    	//textarea - показывать содержание
    	if (preg_match('/<input([^>]*)type="file"([^>]*)>/u', $field)) return '';
//    	if (preg_match('/<input([^>]*)type="text"([^>]*)\/>/u', $field)) return '';
    	if (preg_match('/<textarea([^>]*)>([^<>]*)<\/textarea>/u', $field, $matches))
    	   $field = htmlspecialchars_decode($matches[2], ENT_QUOTES);
        return strtr($this->getRowFormat(), array(
            '%label%'         => $label,
            '%field%'         => $field,
            '%help%'          => $this->formatHelp($help),
        ));
    }
    
    public function formatChoices($choices=array())
    {
    	if (!is_array($choices))
    	   throw new InvalidArgumentException('$choices expected to be an array');
    	$ret='';
    	foreach ($choices as $choice)
    	{
    		$ret.= strtr($this->choicesFormat, array('%choice%'=>$choice));
    	}
    	return strtr($this->multipleChoiceFormat, array('%choices%'=>$ret));
    }

}
?>