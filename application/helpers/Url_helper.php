<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/****
	*	BABAERON - a basic PHP MVC Framework is free software: you can redistribute it and/or modify
	* it under the terms of the GNU General Public License as published by
	* the Free Software Foundation, either version 3 of the License, or
	* (at your option) any later version.

	* BABAERON - a basic PHP MVC Framework is distributed in the hope that it will be useful,
	* but WITHOUT ANY WARRANTY; without even the implied warranty of
	* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	* GNU General Public License for more details.

	* You should have received a copy of the GNU General Public License
	* along with BABAERON - a basic PHP MVC Framework.  If not, see <https://www.gnu.org/licenses/>.
	* 
	* @author 		Ronald M. Marasigan
	* @copyright	Copyright (c) 2018, BABAERON - a basic PHP Framework
	* @license		https://www.gnu.org/licenses	GNU General Public License V3.0
	* @link		https://github.com/BABAERON/Babaeron-PHP-MVC-Framework
	* 
****/

class Url_helper {

	function base_url()
	{
		global $config;
		return $config['base_url'];
	}
	
	function segment($seg)
	{
		if(!is_int($seg)) return false;
		
		$parts = explode('/', $_SERVER['REQUEST_URI']);
	    return isset($parts[$seg]) ? $parts[$seg] : false;
	}
	
	public function redirect($loc)
	{
		global $config;
		
		header('Location: '. $config['base_url'] . $this->language_url($loc));
	}
	
		function load_js($paths)
	{
		foreach ($paths as $path) {
			echo '<script src="' . BASE_URL . 'public/js/' . $path . '.js"></script>' . "\r\n";
		}
	}

	function load_css($paths)
	{
		foreach ($paths as $path) {
			echo '<link rel="stylesheet" href="' . BASE_URL . 'public/css/' . $path . '.css" type="text/css" />' . "\r\n";
		}
	}
	
	function language_url($url) {
		if(isset($_COOKIE['language'])) {
			return $_COOKIE['language'] . '/' . $url;
		} else {
			return $url;
		}
	}
	
	function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
		if(count($url_array) > 2)
			$url = $url_array[2];
		else
			$url = $url_array[1];
		
		if($currect_page == $url){
				echo 'active';
		}
	}
	
}

?>