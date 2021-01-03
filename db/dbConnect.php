<?php 
	class dbConnect {
		private $host = '149.154.70.12';
		private $dbName = 'zakaz';
		private $user = 'admin';
		private $pass = 'admin123456';

		public function connect() {
			try {
				$conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbName, $this->user, $this->pass); $conn -> exec("set names utf8");
				
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conn;
			} catch( PDOException $e) {
				echo 'Ошибка подключения к БД: ' . $e->getMessage();
			}
		}

		
	}

	
 ?>