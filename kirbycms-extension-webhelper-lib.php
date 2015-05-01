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
				"class" => "messagebox messagebox-info"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxSuccess( $text ) {
		$attr = array(
				"class" => "messagebox messagebox-success"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxWarning( $text ) {
		$attr = array(
				"class" => "messagebox messagebox-warning"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxError( $text ) {
		$attr = array(
				"class" => "messagebox messagebox-error"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messageboxValidation( $text ) {
		$attr = array(
				"class" => "messagebox messagebox-validation"
		);
		
		return self::messagebox( $text, $attr );
	}
	
	public static function messagebox( $text, $attr ){
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
		
		if ( $caption !== false )
			$figcaption = \Html::tag("figcaption", self::convert($caption));
		
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
		
		// Search for the first entry
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
					$attribute_array = preg_split("/([[:alnum:]\_]{0,}):[[:blank:]]/i", $name.$tag_attr_string, false, PREG_SPLIT_DELIM_CAPTURE);
				else 
					$attribute_array = preg_split("/([[:alnum:]\_]{0,}):[[:blank:]]/i", $tag_attr_string, false, PREG_SPLIT_DELIM_CAPTURE);
				
				for ($i=1; $i<=(count($attribute_array) - 1); $i+=2) {
					$return[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$attribute_array[$i]] = trim($attribute_array[$i+1]);
				}
			}

			if ( $return[WebHelper::BLOCK_ARRAY_VALUE_TYPE] === WebHelper::BLOCK_TYPE_COMPLEX ) {
				// Get the content
				$return[WebHelper::BLOCK_ARRAY_VALUE_CONTENT] = substr($content, $first_entry_pos_ending, $third_entry_pos-$first_entry_pos_ending);
			}
		}

		return $return;
	}
	
} 