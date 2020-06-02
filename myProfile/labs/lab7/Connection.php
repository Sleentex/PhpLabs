<?php  
	require_once "../connect1/connect.php";

	class Connection {
		private $connection;
		private $host = "localhost";//getenv('DB_HOST');
		private $user = "root";// getenv('DB_USER');
		private $pass =  "";//getenv('DB_PASS');
		private $db = "educational_subjects";//getenv('DB_NAME');

		public function __construct() {
			$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
			if ($this->connection->connect_errno) {
				die("Не удалось подключиться: " . $this->connection->connect_error);
			} 
		}

		public function query($sql) {
			return $this->connection->query($sql);
		}
	}
?>