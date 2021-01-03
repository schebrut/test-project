<?php
    class manager{
        private $id;
        private $nameManager;       
        public $dbConn;

        function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setNameManager($nameManager) { $this->nameManager = $nameManager; }
        function getNameManager() { return $this->nameManager; }

        public function __construct() {
			require_once("dbConnect.php");
			$db = new dbConnect();
			$this->dbConn = $db->connect();
        }

        public function checkExistManager() {
            $sql = "SELECT * FROM manager WHERE name_manager = :name_manager";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(':name_manager', $this->nameManager);
            $stmt->execute();
            $companyArraychec = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($companyArraychec)) {
                return true;               
            }
            else
                return false;  
                    
        }
        
        public function saveManager() {
            $sql = "INSERT INTO `manager`(`id`, `name_manager`) VALUES (null, :name_manager)";
			$stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":name_manager", $this->nameManager);
            $stmt->execute();                                
        }

        public function showManagerList() {
			$sql = "SELECT * FROM manager";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->execute();
            $managerArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $managerArray;
        }

       
       
        
       
       
       
        
    }