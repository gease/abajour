<?php
/**
 * Форматер для форм рецензии в табличном виде, с целью выводить ошибки
 * в нужной форме и помечать необходимые поля
 * @version    SVN: $Id: myWidgetFormSchemaFormatterTable.class.php 165 2009-10-08 13:25:39Z я $
 */

/**
 *
 *
 */
class myWidgetFormSchemaFormatterTable extends sfWidgetFormSchemaFormatter
{
    protected
        $rowFormat          = "<tr>\n  <td>%label%</td>\n  <td>%error%%field%%help%%hidden_fields%</td>\n</tr>\n",
        $requiredRowFormat  = "<tr>\n  <td class=\"required\">%label%</td>\n  <td>%error%%field%%help%%hidden_fields%</td>\n</tr>\n",
        $errorRowFormat     = "<tr><td colspan=\"2\">\n%errors%</td></tr>\n",
        $helpFormat         = '<br />%help%',
        $decoratorFormat    = "<table>\n  %content%</table>",
        $validatorSchema    = null;
        
    public function __construct(sfWidgetFormSchema $widgetSchema, sfValidatorSchema $validatorSchema)
    {
        $this->setWidgetSchema($widgetSchema);
        $this->setValidatorSchema($validatorSchema);
    }
        
    public function formatRow($label, $field, $errors = array(), $help = '', $hiddenFields = null)
    {
    	$required = false;
    	if (is_array($label))
    	{
    		$required = array_shift($label);
    		$label = array_shift($label);
    	}
    	if (!$required)
            return strtr($this->getRowFormat(), array(
                '%label%'         => $label,
                '%field%'         => $field,
                '%error%'         => $this->formatErrorsForRow($errors),
                '%help%'          => $this->formatHelp($help),
                '%hidden_fields%' => is_null($hiddenFields) ? '%hidden_fields%' : $hiddenFields,
            ));
        else
            return strtr($this->getRequiredRowFormat(), array(
                '%label%'         => $label,
                '%field%'         => $field,
                '%error%'         => $this->formatErrorsForRow($errors),
                '%help%'          => $this->formatHelp($help),
                '%hidden_fields%' => is_null($hiddenFields) ? '%hidden_fields%' : $hiddenFields,
            ));
    }
    
    /**
     * Переопределение функции, чтобы засунуть в возвращаемый параметр сведения о том,
     * обязательно поле или нет
     *
     * @see formatRow()
     */
    public function generateLabel($name, $attributes = array())
    {
        $labelName = $this->generateLabelName($name);

        if (false === $labelName)
        {
            return '';
        }

        if (!isset($attributes['for']))
        {
            $attributes['for'] = $this->widgetSchema->generateId($this->widgetSchema->generateName($name));
        }
        $label_tag = $this->widgetSchema->renderContentTag('label', $labelName, $attributes);
        $array = $this->getValidatorSchema()->getFields();
        $required = false;
        if ($array[$name] != null && $array[$name]->hasOption('required') && $array[$name]->getOption('required'))
            $required = true;
        return array($required, $label_tag);
    }
    
    
    public function setValidatorSchema(sfValidatorSchema $validatorSchema)
    {
        $this->validatorSchema = $validatorSchema;
    }
    
    public function getValidatorSchema()
    {
        return $this->validatorSchema;
    }
	
    public function getRequiredRowFormat() {
    	return $this->requiredRowFormat;
    }
}
