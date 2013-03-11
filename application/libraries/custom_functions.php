<?php

if(!function_exists('print_rf')) 
{
	function print_rf($data)
	{
	    echo "<pre>\n";
	    echo "\n". print_r($data, TRUE) ."\n";
	    echo "</pre>\n";    
	}
}

if(!function_exists('simple_date')) 
{
	function simple_date($date) {
		return date('F d, Y', strtotime($date));
	}
}

if(!function_exists('timestamp')) 
{
	function timestamp() {
		return date('Y_m_d_H_i_s', strtotime('now'));
	}
}

