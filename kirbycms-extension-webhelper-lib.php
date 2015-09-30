<?php

namespace at\fanninger\kirby\extension\webhelper;

class WebHelper {
	
	const BLOCK_TYPE_SIMPLE = 1;
	const BLOCK_TYPE_COMPLEX = 2;
	const BLOCK_ARRAY_VALUE_TYPE = "type";
	const BLOCK_ARRAY_VALUE_ATTRIBUTES = "attributes";
	const BLOCK_ARRAY_VALUE_CONTENT = "content";
	const BLOCK_ARRAY_VALUE_STARTPOS = "startpos";
	const BLOCK_ARRAY_VALUE_ENDPOS = "endpos";
	
	public static function messageboxInformation( $text ){
		$attr = array(
				"class" => "alert alert-info",
				"role" => "alert"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxSuccess( $text ) {
		$attr = array(
				"class" => "alert alert-success",
				"role" => "alert"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxWarning( $text ) {
		$attr = array(
				"class" => "alert alert-warning",
				"role" => "alert"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxError( $text ) {
		$attr = array(
				"class" => "alert alert-error",
				"role" => "alert"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxValidation( $text ) {
		$attr = array(
				"class" => "alert alert-validation",
				"role" => "alert"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messagebox( $text, $attr ){
		$text = kirbytext($text);
		return \Html::tag("div", $text, $attr);
	}
	
	/**
	 *
	 * @param string $text
	 * @return string
	 */
	public static function convert($text) {
		$text = htmlentities ( $text );
	
		return $text;
	}	

	public static function blockFigure( $content, $caption = false, $caption_top = false, $caption_class = false ){
		if ( $caption === false )
			return $content;
		
		if ( is_string( $caption ) ) {
			$caption = kirbytext($caption);
			$figcaption = \Html::tag("figcaption", $caption);
		} else
			$figcaption = "";
		
		if ( $caption_top !== false )
			$content = $figcaption . $content;
	  else
	  	$content = $content . $figcaption;
	  
	  $attr = array();
	  
	  if ( $caption_class !== false && !empty( $caption_class ) )
	  	$attr['class'] = $caption_class . (($caption_top !== false)? " figcaption-top" : " figcaption-bottom");
	  else 
	  	$attr['class'] = ($caption_top !== false)? "figcaption-top" : "figcaption-bottom";
	  
	  return \Html::tag("figure", $content, $attr);
	}
	
	/**
	 * @param string $name Name of the block Example: (string) => name = "string"
	 * @param string $content The content for the extraction 
	 * @return array|false Get false back, when no entry ist found.
	 */
	public static function getblock( $name, $content, $offset = 0) {
	  $return = array();
		// Return template
		$return_tmp = array(
		  WebHelper::BLOCK_ARRAY_VALUE_TYPE => 0,								// type of block
			WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES => array(),		// attributes of the first tag
			WebHelper::BLOCK_ARRAY_VALUE_CONTENT => "",						// content from complex block, between start end end tag
		  WebHelper::BLOCK_ARRAY_VALUE_STARTPOS => -1,					// Block start position
			WebHelper::BLOCK_ARRAY_VALUE_ENDPOS => -1							// Block end position
		);
		
		if ( !is_string($content) )
			return false;
		
		// Search for the first entry
		if ( strlen($content) <= $offset )
			return false;
		
		$first_entry_pos = strpos($content, "(".$name, $offset);
		if ( $first_entry_pos === false )
			return false;
		
		// Find second start entry
		$second_entry_pos = strpos($content, "(".$name, $first_entry_pos+1);
		
		// Find end position
		$third_entry_pos = strpos($content, "(/".$name, $first_entry_pos+1);
		
		if ( $first_entry_pos === false ) {
			// Nothing found
			$return = false;
		} else{
			$return = $return_tmp;
			$return[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS] = $first_entry_pos;
			
			if ( $third_entry_pos === false || ( $second_entry_pos !== false && $second_entry_pos < $third_entry_pos ) ) {
				$return[WebHelper::BLOCK_ARRAY_VALUE_TYPE] = WebHelper::BLOCK_TYPE_SIMPLE;
				
				$first_entry_pos_ending = strpos($content, ")", $first_entry_pos)+1;
				$return[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS] = $first_entry_pos_ending;
			} elseif ( $third_entry_pos !== false ) {
				$return[WebHelper::BLOCK_ARRAY_VALUE_TYPE] = WebHelper::BLOCK_TYPE_COMPLEX;
				
				$first_entry_pos_ending = strpos($content, ")", $first_entry_pos)+1;
				$third_entry_pos_ending = strpos($content, ")", $third_entry_pos)+1;
				$return[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS] = $third_entry_pos_ending;
			}
			
			// Analysis the first block
			$attr_start_pos = $first_entry_pos+strlen("(".$name);
			$attr_length = $first_entry_pos_ending-$attr_start_pos-1;
			$tag_attr_string = substr($content, $attr_start_pos, $attr_length);
			
			if ( strlen($tag_attr_string) > 0 ) {
				if ( substr($tag_attr_string, 0, 1) == ":" )
					$attribute_array = preg_split("/([[:alnum:]\_\-]{0,}):[[:blank:]]/i", $name.$tag_attr_string, false, PREG_SPLIT_DELIM_CAPTURE);
				else 
					$attribute_array = preg_split("/([[:alnum:]\_\-]{0,}):[[:blank:]]/i", $tag_attr_string, false, PREG_SPLIT_DELIM_CAPTURE);
				
				for ($i=1; $i<=(count($attribute_array) - 1); $i+=2) {
					$return[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$attribute_array[$i]] = trim($attribute_array[$i+1]);
				}
			}

			if ( $return[WebHelper::BLOCK_ARRAY_VALUE_TYPE] === WebHelper::BLOCK_TYPE_COMPLEX ) {
				// Get the content
				$return[WebHelper::BLOCK_ARRAY_VALUE_CONTENT] = substr($content, $first_entry_pos_ending, $third_entry_pos-$first_entry_pos_ending);
				$return[WebHelper::BLOCK_ARRAY_VALUE_CONTENT] = trim($return[WebHelper::BLOCK_ARRAY_VALUE_CONTENT], " \n\r");
			}
		}

		return $return;
	}
	
	public static function startsWith($haystack, $needle) {
		// search backwards starting from haystack length characters from the end
		return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
	}
	
	public static function endsWith($haystack, $needle) {
		// search forward starting from end minus needle length characters
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}
	
	public static function calcAge($dayOfBirth, $dayStringFormat = 'd/m/Y', $timeszone = 'Europe/Vienna'){
		$tz  = new \DateTimeZone($timeszone);
		return \DateTime::createFromFormat($dayStringFormat, $dayOfBirth, $tz)->diff(new \DateTime('now', $tz))->y;
	}
	
	public static function snippetAttribute($value, $key=null){
		if(is_array($value) && $key !== null){
			if(array_key_exists($key, $value)){
				echo $value[$key];
			}
		}elseif(!is_array($value)){
			echo $value;
		}else{
			echo "unknown variable";
		}
	}
} 