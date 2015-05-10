<?php

use at\fanninger\kirby\extension\webhelper\WebHelper;

require_once 'kirbycms-extension-webhelper-lib.php';

kirbytext::$pre[] = function($kirbytext, $value) {
	
	/*
	 * Messagebox - Info
	 */
	$offset = 0;
	$key = 'info';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		if ( !empty($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]) )
			$block_new = WebHelper::messageboxInformation($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]);
		else
			$block_new = WebHelper::messageboxInformation($block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$key]);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		
		$value = substr_replace($value, $block_new, $start, $length);
	}

	/*
	 * Messagebox - Success
	 */
	$offset = 0;
	$key = 'success';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		if ( !empty($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]) )
			$block_new = WebHelper::messageboxSuccess($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]);
		else
			$block_new = WebHelper::messageboxSuccess($block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$key]);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
	
		$value = substr_replace($value, $block_new, $start, $length);
	}

	/*
	 * Messagebox - Warning
	 */
	$offset = 0;
	$key = 'warning';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		if ( !empty($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]) )
			$block_new = WebHelper::messageboxWarning($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]);
		else
			$block_new = WebHelper::messageboxWarning($block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$key]);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
	
		$value = substr_replace($value, $block_new, $start, $length);
	}

	/*
	 * Messagebox - Error
	 */
	$offset = 0;
	$key = 'error';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		if ( !empty($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]) )
			$block_new = WebHelper::messageboxError($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]);
		else
			$block_new = WebHelper::messageboxError($block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$key]);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
	
		$value = substr_replace($value, $block_new, $start, $length);
	}

	/*
	 * Messagebox - Validation
	 */
	$offset = 0;
	$key = 'validation';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		if ( !empty($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]) )
			$block_new = WebHelper::messageboxValidation($block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT]);
		else 
			$block_new = WebHelper::messageboxValidation($block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$key]);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
	
		$value = substr_replace($value, $block_new, $start, $length);
	}
	
	/*
	 * Calculate age
	 */
	$offset = 0;
	$key = 'age';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		$block_new = WebHelper::calcAge($block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES][$key]);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
	
		$value = substr_replace($value, $block_new, $start, $length);
	}
	
	/*
	 * Figure
	 */
	$offset = 0;
	$key = 'figure';
	while ( ($block = WebHelper::getblock($key, $value, $offset)) !== false ) {
		$offset = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS];
		$content = $block[WebHelper::BLOCK_ARRAY_VALUE_CONTENT];
		$caption = ( array_key_exists('caption', $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES]) )? $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES]['caption']: false;
		$caption = ( empty($caption) )? false : $caption;
		$caption_top = ( array_key_exists('caption_top', $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES]) )? $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES]['caption_top']: false;
		$caption_top = ( $caption_top === "false" || empty($caption_top) )? false: $caption_top;
		$caption_class = ( array_key_exists('class', $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES]) )? $block[WebHelper::BLOCK_ARRAY_VALUE_ATTRIBUTES]['class']: false;
		
		$block_new = WebHelper::blockFigure($content, $caption, $caption_top, $caption_class);
		$start = $block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
		$length = $block[WebHelper::BLOCK_ARRAY_VALUE_ENDPOS]-$block[WebHelper::BLOCK_ARRAY_VALUE_STARTPOS];
	
		$value = substr_replace($value, $block_new, $start, $length);
	}
	
	return $value;
};