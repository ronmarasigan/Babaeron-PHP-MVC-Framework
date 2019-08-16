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

class Security_plugin {

	/***** Sanitize string before echoing *****/
	//We will use HTMLPurifier if needed
	function SanitizeString($string)
	{
		//replace this with anti XSS method if you will allow end-user to insert html elements and attributes
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
	
	/***** Clean every user input before performing queries *****/
	//We can simply remove unnecessary strings here
	function cleanInput($string, $type=null)
	{
		//put here you cleaning method
		$string = trim($string);
		return $string;
	}
	
	/***** CSRF Protection *****/
	//Just a basic implementation
	function CSRFToken()
	{
		$_SESSION['token'] = bin2hex(random_bytes(32));
		return $_SESSION['token'];
	}
	
	function CSRFProtect($token)
	{
		if(hash_equals($_SESSION['token'], $token))
			return true;
		else
			return false;
	}
}

?>