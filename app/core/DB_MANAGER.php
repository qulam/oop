<?php

namespace app\core;

class DB_MANAGER
{
	private static $host;
	private static $db;
	private static $user;
	private static $pass;
	private static $charset;
	// public $connect;

	public function __construct()
	{

		self::$host = 'localhost';
		self::$db = 'oop';
		self::$user = 'root';
		self::$pass = '';
		self::$charset = 'utf8';

		$this->connect_db();

	}

	public function connect_db()
	{
		try {
			return $connect = new \PDO("mysql:host=".self::$host.";dbname=".self::$db.";charset=".self::$charset.";", self::$user, self::$pass);

		} catch (Exception $e) {
			echo $e->getmessage();

		}

	}



}