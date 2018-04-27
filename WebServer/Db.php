<?php 

/**
 * 单例模式访问MYSQL数据库
 * 引入类后直接通过getInstance()获取对象
 */
class Db {

	private static $_instance;
	public static $dbObj;

	const DSN = 'mysql:host=localhost:9999;dbname=ibook';
	const USERNAME = 'root';
	const PASSWORD = 'root';

	public function __construct() {

	}

	static public function getInstance() {
		if(!(self::$_instance instanceof self)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function connect() {
		if(!self::$dbObj) {
			try {
				self::$dbObj = new PDO(self::DSN, self::USERNAME, self::PASSWORD);
			} catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
		return self::$dbObj;
	}
}