<?php
class DB{
	private $server = "localhost";
	private $username = "kuzuro";
	private $pass = "1111";
	private $db = "test";
	private $conn = null;

	public function __construct(){
		$this->conn = new mysqli($this->server, $this->username, $this->pass, $this->db);
	}

	public function getConnection(){
		return $this->conn;
	}

	function html_escape(string $string): string
	{
		return htmlspecialchars($string, ENT_QUOTES|ENT_HTML5, 'UTF-8', true);
	}
}
?>