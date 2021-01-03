<?php
    class company{
        private $id;
        private $nameCompany;       
        public $dbConn;

        function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setNameCompany($nameCompany) { $this->nameCompany = $nameCompany; }
        function getNameCompany() { return $this->nameCompany; }

        public function __construct() {
			require_once("dbConnect.php");
			$db = new dbConnect();
			$this->dbConn = $db->connect();
        }

        public function checkExistCompany() {
            $sql = "SELECT * FROM company WHERE name_company = :name_company";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(':name_company', $this->nameCompany);
            $stmt->execute();
            $companyArraychec = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($companyArraychec)) {
                return true;               
            }
            else
                return false;  
                    
        }
        
        public function saveCompany() {
            $sql = "INSERT INTO `company`(`id`, `name_company`) VALUES (null, :name_company)";
			$stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":name_company", $this->nameCompany);
            $stmt->execute();                                
        }

        public function showCompaliList() {
			$sql = "SELECT * FROM company";
			$stmt = $this->dbConn->prepare($sql);
			$stmt->execute();
            $companyArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $companyArray;
        }

        

       
       
        
       
       
       
        
    }