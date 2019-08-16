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
	* Used for: MinSU Enrollment System
	* Babaeron Framework
	* Developer: MinSU Dev Team
	* July 01, 2019
****/

class Controller {
	public function __construct()
	{
		global $config;
		$this->loadHelper($config['helpers']);
		$this->loadModel($config['models']);
		$this->loadPlugin($config['plugins']);
	}
	
	/***** Load Model *****/
	public function loadModel($params = [])
	{
		if(is_array($params))
		{
			foreach($params as $param)
			{
				require(APP_DIR .'models/'. strtolower($param) .'.php');
				$this->$param = new $param;			
			}
		}
		else
		{
			return false;
		}
	}
	
	/***** Load View *****/
	public function loadView($name)
	{
		$view = new View($name);
		return $view;
	}
	/***** Load Plugins *****/
	
	public function loadPlugin($params = [])
	{
		if(is_array($params))
		{
			foreach($params as $param)
			{
				require(APP_DIR .'plugins/'. strtolower($param) .'.php');
				$this->$param = new $param;			
			}
		}
		else
		{
			return false;
		}
	}
	
	/***** Load Helper *****/
	public function loadHelper($params = [])
	{
		if(is_array($params))
		{
			foreach($params as $param)
			{
				require(APP_DIR .'helpers/'. strtolower($param) .'.php');
				$this->$param = new $param;			
			}
		}
		else
		{
			return false;
		}
	}
}

?>