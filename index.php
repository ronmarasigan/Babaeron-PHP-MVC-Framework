<?php
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
****/

/***** Start Session *****/
session_start(); 

/***** Prevent direct access to include file *****/
define('BASEPATH', true);

/***** Define Constants *****/
define('ROOT_DIR',  realpath(__DIR__) . '/');
define('APP_DIR', ROOT_DIR .'application/');

/***** Required Files *****/
require(APP_DIR .'config/config.php');
require(APP_DIR .'function/function.php');
require(ROOT_DIR .'autoload.php');
autoload();

/***** Base URL *****/
define('BASE_URL', $config['base_url']);

/***** Route *****/
$babaeron = new Babaeron();
$babaeron->route();

?>
