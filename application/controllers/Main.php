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

class Main extends Controller {

	function __construct()
	{
		parent:: __construct();
	}
	
	function index()
	{
		$template = $this->loadView('main_view');
		$template->render();
	}
}
?>
