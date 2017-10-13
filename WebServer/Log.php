<?php 


/**
 * 记录Admin System 所有操作记录
 * 
 */
class Log {

	const ACTIONLIST = array();

	private $user_id = '';
	private $action  = '';
	private $detail  = '';

	public function __construct() {

	}

	public function set_user($user_id) {
		$this->$user_id = $_GET['user_id'];
	}

	public function set_action($action) {
		$this->$action = $_GET['action'];
	}

	public function set_detail($detail) {
		$this->detail = $_GET['detail'];
	}

	public function log_data($time) {
		if($this->$user_id || $this->$action || $this->$detile) {
			return '';
		}
		
	}
}