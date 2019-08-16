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

class Babaeron {
	
	public function route()
	{
		global $config;
			
		/***** Set our defaults *****/
		$controller = $config['default_controller'];
		$action = $config['default_method'];
		$url = '';
		
		/***** Get request url and script url *****/
		$request_url = (isset($_SERVER['REQUEST_URI'])) ? $_SERVER['REQUEST_URI'] : '';
		$script_url  = (isset($_SERVER['PHP_SELF'])) ? $_SERVER['PHP_SELF'] : '';
		
		/***** Get our url path and trim the / of the left and the right *****/
		if($request_url != $script_url) $url = trim(preg_replace('/'. str_replace('/', '\/', str_replace('index.php', '', $script_url)) .'/', '', $request_url, 1), '/');
			
		/***** Split the url into segments *****/
		$segments = explode('/', $url);
		
		/***** Language Setting *****/
		if(in_array($segments[0], $config['available_languages'])) {
			if(file_exists(APP_DIR . 'languages/' . strtolower($segments[0]) . '_lang.php')) {
				require_once(APP_DIR . 'languages/' . strtolower($segments[0]) . '_lang.php');
				setcookie("language", strtolower($segments[0]), time() + (60*60*24*30));
				unset($segments[0]);
			} 
		} else {
				if(file_exists(APP_DIR . 'languages/' . strtolower($config['default_language']) . '_lang.php') && !defined('LANG')) {
					require_once(APP_DIR . 'languages/' . strtolower($config['default_language']) . '_lang.php');
					setcookie("language", strtolower($config['default_language']), time() + (60*60*24*30));
				}
		}
		
		/***** Do our default checks *****/
		if(isset($segments[1]) && !empty($segments[1])) $controller = $segments[1];
		if(isset($segments[2]) && !empty($segments[2])) $action = str_replace('-', '_', $segments[2]);

		/***** Get our controller file *****/
		if(file_exists(APP_DIR . 'controllers/' . $controller . '.php')){
					require_once(APP_DIR . 'controllers/' . $controller . '.php');
		} else {
					$controller = $config['error_controller'];
					require_once(APP_DIR . 'controllers/' . $controller . '.php');
		}
			
			/***** Check the action if callable *****/
			if(!method_exists($controller, $action)){
					$controller = $config['error_controller'];
					require_once(APP_DIR . 'controllers/' . $controller . '.php');
					$action = 'index';
			}
		
		/***** Create object and call method *****/
		$obj = new $controller;
			die(call_user_func_array(array($obj, $action), array_slice($segments, 2)));
	}
}
?>
