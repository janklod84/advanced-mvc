<?php 


/**
 * Input Form
 * @param string $type 
 * @param string $label 
 * @param string $name 
 * @param string $value 
 * @param array $inputAttrs 
 * @param array $divAttrs 
 * @return string
 */
function inputBlock(
	$type, 
	$label, 
	$name, 
	$value = '', 
	$inputAttrs = [], 
	$divAttrs = []
)
{
	 $divString = stringifyAttrs($divAttrs);
	 $inputString = stringifyAttrs($inputAttrs);
     $html  = '<div'. $divString . '>';
     $html .= '<label for="'. $name .'">'. $label .'</label>';
     $html .= '<input type="'.$type.'" id="'.$name.'" name="'.$name.'" value="'.$value.'"'. $inputString.'/>';
     $html .= '</div>';

     return $html;
}


/**
 * Generate input submit
 * @param string $buttonText 
 * @param array $inputAttrs 
 * @return string
 */
function submitTag($buttonText, $inputAttrs=[])
{
	$inputString = stringifyAttrs($inputAttrs);
	$html = '<input type="submit" value="'.$buttonText.'"'. $inputString.' />';
	return $html;
}



/**
 * Generate button submit
 * @param string $buttonText 
 * @param array $inputAttrs 
 * @param array $divAttrs 
 * @return string
 */
function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[])
{
	$divString = stringifyAttrs($divAttrs);
	$inputString = stringifyAttrs($inputAttrs);
	$html = '<div'.$divString.'>';
	$html .= '<input type="submit" value="'.$buttonText.'"'. $inputString.' />';
	$html .= '</div>';
	return $html;
}


/**
 * StringiFy Attributes
 * @param array $attrs
 */
function stringifyAttrs($attrs)
{
     $string = '';
     foreach($attrs as $key => $value)
     {
     	$string .= ' ' . $key . '="'. $value.'"';
     }
     return $string;
}