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

/***** Dev Model: "PRODUCTION OR DEVELOPMENT" *****/
$config['dev_mode'] = true;
if($config['dev_mode'] == true) {
	error_reporting(E_ALL);
	ini_set('display_errors', 1); 
} else {
	error_reporting(E_NOTICE);
	ini_set('display_errors', 0); 
}

/***** Memory Limit: *****/
//This sets the maximum amount of memory in bytes that a script is allowed to allocate.
//Set to -1 if not set
ini_set('memory_limit', '512M');

/***** Default Timezone *****/
date_default_timezone_set('Asia/Manila');

/***** Base URL including trailing slash (e.g. http://localhost/) *****/
$config['base_url'] = '';

/***** Default controller to load *****/
$config['default_controller'] = 'Main';
$config['default_method'] = 'index';
$config['error_controller'] = 'Errors';

/***** Languages *****/
$config['default_language'] = 'tag';
$config['available_languages'] = ['en', 'tag'];

/***** Database Information *****/
$config['db_host'] = '';
$config['db_name'] = '';
$config['db_username'] = '';
$config['db_password'] = '';
$config['table_prefix'] = '';

/***** Autoload Helpers *****/
// Example $config['models'] = ['example_model']; see models to see others
$config['models'] = [];

// Example $config['helpers'] = ['url_helper']; see helpers to see others
$config['helpers'] = [];

/***** Autoload Plugins *****/
// Example $config['plugins'] = ['example_plugin']; see plugins to see others');
$config['plugins'] = [];

?>