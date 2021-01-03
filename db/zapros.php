<?php
    class zapros{
        private $id;
        private $clientId;
        private $nameCompany;
        private $idCompany;
        private $levelZapros;
        private $messageZapros;
        private $manager;
        private $answer;
        private $statuszapros;        
        public $dbConn;

        function setId($id) { $this->id = $id; }
        function getId() { return $this->id; }
        
        function setclientId($clientId) { $this->clientId = $clientId; }
        function getclientId() { return $this->clientId; }

		function setNameCompany($nameCompany) { $this->nameCompany = $nameCompany; }
        function getNameCompany() { return $this->nameCompany; }
        
        function setidCompany($idCompany) { $this->idCompany = $idCompany; }
        function getidCompany() { return $this->idCompany; }

        function setlevelZapros($levelZapros) { $this->levelZapros = $levelZapros; }
        function getlevelZapros() { return $this->levelZapros; }

        function setmessage($messageZapros) { $this->messageZapros = $messageZapros; }
        function getmessage() { return $this->messageZapros; }

        function setmanager($manager) { $this->manager = $manager; }
        function getmanager() { return $this->manager; }

        function setanswer($answer) { $this->answer = $answer; }
        function getanswer() { return $this->answer; }

        function setstatus($statuszapros) { $this->statuszapros = $statuszapros; }
        function getstatus() { return $this->statuszapros; }


        public function __construct() {
			require_once("dbConnect.php");
			$db = new dbConnect();
			$this->dbConn = $db->connect();
        }

        
    
        public function savezapros() {
            $sql = "INSERT INTO `zapros`(`id`, `client_id`,  `level_zapros`, `kompany`, `message`, `manager`, `answer`, `status`) VALUES (null, :clientId, :levelZapros, :nameCompany, :messageZapros, :manager, :answer, :statuszapros )";
			$stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":clientId", $this->clientId);
            $stmt->bindParam(":levelZapros", $this->levelZapros);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
            $stmt->bindParam(":messageZapros", $this->messageZapros);
            $stmt->bindParam(":manager", $this->manager);
            $stmt->bindParam(":answer", $this->answer);
            $stmt->bindParam(":statuszapros", $this->statuszapros);            
            $stmt->execute(); 
            return true;                               
        }

        public function showZaprosList() {
			$sql = "SELECT * FROM zapros";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
			$stmt->execute();
            $zaprosArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $zaprosArray;
        }
        public function managerZaprosList() {
			$sql = "SELECT * FROM zapros WHERE   manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameManager", $this->manager);
			$stmt->execute();
            $managerZaprosList = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $managerZaprosList;
        }
       
        public function closeZapros() {
			$sql = "DELETE FROM zapros WHERE  id = :id";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":id", $this->id);
			$stmt->execute();          
            return true;
        }
       
       
       
        
    }