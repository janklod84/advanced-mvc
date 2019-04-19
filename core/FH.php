<?php 


/**
 * FH (Form Helpers)
 * @package FH
*/
class FH 
{


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
		public static function inputBlock(
			$type, 
			$label, 
			$name, 
			$value = '', 
			$inputAttrs = [], 
			$divAttrs = []
		)
		{
			 $divString   = self::stringifyAttrs($divAttrs);
			 $inputString = self::stringifyAttrs($inputAttrs);
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
		public static function submitTag($buttonText, $inputAttrs=[])
		{
			$inputString = self::stringifyAttrs($inputAttrs);
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
		public static function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[])
		{
			$divString   = self::stringifyAttrs($divAttrs);
			$inputString = self::stringifyAttrs($inputAttrs);
			$html = '<div'.$divString.'>';
			$html .= '<input type="submit" value="'.$buttonText.'"'. $inputString.' />';
			$html .= '</div>';
			return $html;
		}


		/**
		 * StringiFy Attributes
		 * @param array $attrs
		 */
		public static function stringifyAttrs($attrs)
		{
		     $string = '';
		     foreach($attrs as $key => $value)
		     {
		     	$string .= ' ' . $key . '="'. $value.'"';
		     }
		     return $string;
		}

        
        /**
         * Generate Token
         * @return string
         */
		public static function generateToken()
		{
            $token = base64_encode(openssl_random_pseudo_bytes(32));
            Session::set('csrf_token', $token);
            return $token;
		}

        
        /**
         * Check Token if exist and matched given token $token
         * @param string $token 
         * @return bool
        */
		public static function checkToken($token)
		{
			return (Session::exists('csrf_token') && Session::get('csrf_token') == $token);
		}


		public static function csrfInput()
		{
			return '<input type="hidden" name="csrf_token" id="csrf_token" value="'. self::generateToken() .'" />';
		}

}