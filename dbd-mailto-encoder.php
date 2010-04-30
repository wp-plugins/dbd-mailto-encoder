<?php
/*
Plugin Name: DBD Mailto Encoder
Plugin URI: http://www.dontblinkdesign.com/wordpress-dbd-mailto-encoder
Description: Searches all content for "mailto:" links, then unicodes them to protect from spiders.
Version: 1.0
Author: Don't Blink Design
Author URI: http://www.dontblinkdesign.com/wordpress-dbd-mailto-encoder-author
*/

class dbd_mailto_encoder
{
	var $mailto_pattern = "\"(mailto:[^\\\"]+)\"";

	function dbd_mailto_encoder()
	{
		//add filter to content
		add_filter('the_content', array(&$this, 'the_filter'));
	}

	function the_filter($s)
	{
		$s = preg_replace_callback($this->mailto_pattern, array(&$this, "mailto_call_back"), $s);
		return $s;
	}

	function mailto_call_back($arr)
	{
		return $this->email_encode($arr[1]);
	}

	function email_encode($str)
	{
		$str2 = "";
		$n = strlen($str);
		for ($i = 0; $i < $n; $i++)
			$str2 .= "&#".ord($str[$i]).";";
		return $str2;
	}
} // end class

// Instantiate dbd_mailto_encoder class
$dbd_me = new dbd_mailto_encoder();
?>