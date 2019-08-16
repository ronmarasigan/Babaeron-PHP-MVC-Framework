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

class Model {

	private $_pdo, $_query, $_count = 0, $_results = array(), $_lastID = NULL, $_errors = array(), $dbuser, $dbname, $dbpass, $dbhost, $tbprefix;

	private static $_instance = NULL;

	public function __construct() {
	global $config;
		$this->dbhost = $config['db_host'];
		$this->dbname = $config['db_name'];
		$this->dbuser = $config['db_username'];
		$this->dbpass = $config['db_password'];
		$this->tbprefix = $config['table_prefix'];
		try {
			
			$this->_pdo = new PDO('mysql:host='.$this->dbhost.';dbname='.$this->dbname.';charset=utf8', $this->dbuser, $this->dbpass);
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->_pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		} catch(PDOException $e) {

			$this->_errors[] = $e->getMessage();

			die('Failed connecting to database');

		}

	}

	public function transaction() {
		$this->_pdo->beginTransaction();
		return $this;
	}

	public function roll() {
		$this->_pdo->rollBack();
		return $this;
	}

	public function commit() {
		$this->_pdo->commit();
		return $this;
	}

	public function query($query, $params = array()) {
		$this->_query = NULL;
		$this->_results = NULL;
		$this->_count = 0;
		$this->_lastID = NULL;

		try {
			$this->_query = $this->_pdo->prepare($query);
			if(count($params)) {
				$i = 1;
				foreach($params AS $param) {
					$this->_query->bindValue($i, $param);
					$i++;
				}
			}

			$this->_query->execute();
			$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
			$this->_count = $this->_query->rowCount();
			$this->_lastID = $this->_pdo->lastInsertID();
		} catch(PDOException $e) {
			$this->_errors[] = $e->getMessage();
		}
		return $this;
	}

	private function action($action, $table, $conditions) {
		if(count($conditions) == 3) {
			$column = $conditions[0];
			$operator = $conditions[1];
			$value = $conditions[2];
			$this->query($action . ' `' . $table . '` WHERE `'.$column.'` ' . $operator . ' ?', array($value));
			return $this;
		}
	}

	public function row($value) {
		return $this->results()[0]->$value;
	}

	public function all($table) {
		return $this->query('SELECT * FROM `' . $this->tbprefix . $table . '`')->results();
	}

	public function insert($table, $values) {
		if(count($values)) {
			$query = 'INSERT INTO `' . $this->tbprefix . $table . '` (';
			$keys = array_keys($values);
			$bind = array_values($values);
			$i = 1;
			foreach($keys AS $key) {
				$query .= '`'.$key.'`';
				if($i < count($keys)) {
					$query .= ', ';
				}
				$i++;
			}
			$query .= ') VALUES(';
			for($i = 1; $i <= count($keys); $i++) {
				$query .= '?';
				if($i < count($keys)) {
					$query .= ', ';
				}
			}
			$query .= ')';
			$this->query($query, $bind);
			return $this;
		}
	}

	public function update($table, $values, $conditions) {
		if(count($values) AND count($conditions)) {
			$query = 'UPDATE `' . $this->tbprefix . $table . '` SET ';
			$fields = array_keys($values);
			$i = 1;
			foreach($fields AS $field) {
				$query .= ' `'. $field . '` = ?';
				if($i < count($fields)) {
					$query .= ', ';
				}
				$i++;
			}
			$query .= ' WHERE `' . $conditions[0] . '` ' . $conditions[1] . ' ?';
			$arr = array_values($values);
			array_push($arr, $conditions[2]);
			$this->query($query, $arr);
			return $this;
		}
	}

	public function get($table, $conditions = NULL) {
		if($conditions) {
			$this->action('SELECT * FROM', $this->tbprefix . '' . $table, $conditions);
		} else {
			$this->query('SELECT * FROM `' . $this->tbprefix . $table . '`');
		}
		return $this;
	}

	public function del($table, $conditions) {
		$this->action('DELETE FROM', $this->tbprefix . $table, $conditions);
		return $this;
	}

	public function errors() {
		return $this->_errors;
	}

	public function results() {
		return $this->_results;
	}

	public function row_count() {
		return $this->_count;
	}

	public function last_id() {
		return $this->_lastID;
	}

	public function get_pdo() {
		return $this->_pdo;
	}

}