<?php
    class project{
        private $id;
        private $nameCompany;
        private $nameManager;
        private $projectLoad;  
        private $ManagerKolProjacts;
        private $ManagerLastLoad;
        private $LastCompany;
        private $MaxLoadInProject;  
        private $NewManager; 
        
        
        public $dbConn;

        function setId($id) { $this->id = $id; }
		function getId() { return $this->id; }
		function setNameCompany($nameCompany) { $this->nameCompany = $nameCompany; }
        function getNameCompany() { return $this->nameCompany; }

        function setnameManager($nameManager) { $this->nameManager = $nameManager; }
        function getnameManager() { return $this->nameManager; }

        function setnameNewManager($NewManager) { $this->NewManager = $NewManager; }
        

        function setprojectLoad($projectLoad) { $this->projectLoad = $projectLoad; }
        function getprojectLoad() { return $this->projectLoad; }

        function setManagerKolProjacts($ManagerKolProjacts) { $this->ManagerKolProjacts = $ManagerKolProjacts; }
        function getManagerKolProjacts() { return $this->ManagerKolProjacts; }

        function setManagerLastLoad($ManagerLastLoad) { $this->ManagerLastLoad = $ManagerLastLoad; }
        function getManagerLastLoad() { return $this->ManagerLastLoad; }

        function setLastCompany($LastCompany) { $this->LastCompany = $LastCompany; }
        function getLastCompany() { return $this->LastCompany; }

        function setMaxLoadInProject($MaxLoadInProject) { $this->MaxLoadInProject = $MaxLoadInProject; }
        function getMaxLoadInProject() { return $this->MaxLoadInProject; }

        public function __construct() {
			require_once("dbConnect.php");
			$db = new dbConnect();
			$this->dbConn = $db->connect();
        }

        
        
        public function saveProjects() {
            $sql = "INSERT INTO `projects`(`id`, `company`,  `manager`, `projectt_load`) VALUES (null, :nameCompany, :nameManager, :projectLoad )";
			$stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
            $stmt->bindParam(":nameManager", $this->nameManager);
            $stmt->bindParam(":projectLoad", $this->projectLoad);
            $stmt->execute(); 
            return true;                               
        }

        public function updateLastLoad(){
            $sql = "UPDATE projects SET projectt_load = :projectt_load  WHERE  company = :nameCompany AND manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(':projectt_load', $this->ManagerLastLoad); 
            $stmt->bindParam(':nameCompany', $this->LastCompany);
            $stmt->bindParam(':nameManager', $this->nameManager);                
            $stmt->execute();            
            
        }
        

        public function showProjectList() {
			$sql = "SELECT * FROM projects WHERE  company = :nameCompany";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
			$stmt->execute();
            $projectArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $projectArray;
        }
       
        public function checkManagerInProject() {
            
            require_once("manager.php");
            $managerlist =  new manager();
            $managerARR = $managerlist->showManagerList();
            $name_manager_free='';
            $totalLoad=0;
            $managernametoModal = array();
            foreach ($managerARR as $managerItem){
               
                $this->setnameManager($managerItem['name_manager']);
                $totalLoad = $this->checkManagerTotalLoadInAllProjects();

                if ($totalLoad<40){
			$sql = "SELECT manager FROM projects WHERE  company = :nameCompany AND manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);

            $stmt->bindParam(":nameCompany", $this->nameCompany);
            $stmt->bindParam(":nameManager", $this->nameManager);
            
			$stmt->execute();
                        
            while($row = $stmt->fetch())
                {                                       
                    $name_manager_free =  $row['manager'];                    
                }  
                if ($managerItem['name_manager']<> $name_manager_free){                    
                    array_push($managernametoModal, $managerItem['name_manager']);          
                   
                }
               
                }
            }
               return $managernametoModal;
         }
       
         public function checkExistManager() {
            $sql = "SELECT manager FROM projects WHERE  company = :nameCompany AND manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
            $stmt->bindParam(":nameManager", $this->nameManager);
            $stmt->execute();
            $companyArraychec = $stmt->fetch(PDO::FETCH_ASSOC);
            if(empty($companyArraychec)) {
                return true;               
            }
            else
                return false;  
                    
        }
        

        public function checkManagerTotalProjects() {
            $Kolproj = 0;

            $sql = "SELECT 	manager FROM projects WHERE  manager = :nameManager";
           
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameManager", $this->nameManager);
			$stmt->execute();
            while($row = $stmt->fetch())
                {                                       
                    if ($row['manager'] == $this->nameManager)  {
                        $Kolproj = $Kolproj+1;
                    }                 
                }
                return $Kolproj;
        }


        
        public function checkInWhatCompaniesManager() {
            $sql = "SELECT 	company FROM projects WHERE  manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);            
            $stmt->bindParam(":nameManager", $this->nameManager);
            $stmt->execute();
            $checkInWhatCompan = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $checkInWhatCompan;
                               
        }

        public function checkManagerTotalLoadInAllProjects() {
            $totalLoad = 0;

            $sql = "SELECT projectt_load FROM projects WHERE  manager = :nameManager";           
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameManager", $this->nameManager);
			$stmt->execute();
            while($row = $stmt->fetch())                {                                       
                    
                        $totalLoad = $totalLoad+$row['projectt_load'];                                     
                }
                return $totalLoad;
        }

        
        public function checkManagerTotalLoadInAllZapros() {
            $totalLoadZapros = 0;

            $sql = "SELECT level_zapros FROM zapros WHERE  manager = :nameManager";           
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameManager", $this->nameManager);
			$stmt->execute();
            while($row = $stmt->fetch())                {                                       
                    
                        $totalLoadZapros = $totalLoadZapros+$row['level_zapros'];                                     
                }
                return $totalLoadZapros;
        }

        public function checkManagerTotalLoad() {
            $loadinProject = 0;
            $loadinZapros = 0;
            $totalLoad = 0;
           
            
            $loadinProject = $this->checkManagerTotalLoadInAllProjects();
            $loadinZapros = $this->checkManagerTotalLoadInAllZapros();
            $totalLoad = $loadinProject+$loadinZapros;
            return $totalLoad;


        }
        


        public function checkCompanyLoad() {
            $totalLoadmanagerInCompany = 0;

            $sql = "SELECT level_zapros FROM zapros WHERE  manager = :nameManager AND kompany = :nameCompany ";           
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameManager", $this->nameManager);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
			$stmt->execute();
            while($row = $stmt->fetch())                {                                       
                    
                        $totalLoadmanagerInCompany = $totalLoadmanagerInCompany+$row['level_zapros'];                                     
                }
                return $totalLoadmanagerInCompany;
        }


        public function showProjectListbyID() {
			$sql = "SELECT * FROM projects WHERE  id = :id";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":id", $this->id);
			$stmt->execute();
            $projectArray = $stmt->fetch(PDO::FETCH_ASSOC);
            return $projectArray;
        }

        public function deleteManagerFromCompany() {
			$sql = "DELETE FROM projects WHERE  id = :id";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":id", $this->id);
			$stmt->execute();          
            return true;
        }
       

        public function updateManagerLoadDelete(){
            $sql = "UPDATE projects SET projectt_load = :projectt_load  WHERE  manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(':projectt_load', $this->ManagerLastLoad);             
            $stmt->bindParam(':nameManager', $this->nameManager);                
            $stmt->execute();            
            
        }

        public function checkMostFreeManager() {
            $nameManager = '';
            $minload = 1000;
            $i=0;
 
            $sql = "SELECT 	manager FROM projects WHERE  company = :nameCompany";
            $minload = 1000;
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
			$stmt->execute();
            while($row = $stmt->fetch())
                {                      
                   $i=$i+1;
                   $nameManager = $row['manager'];    
                   $this->setnameManager($nameManager);
                   $totalLoad =  $this->checkManagerTotalLoadInAllProjects();                 
                   $totalLoadZapros =  $this->checkManagerTotalLoadInAllZapros();
                   $itogTotalLoad = $totalLoad+$totalLoadZapros;
                   if ($minload>=($itogTotalLoad)){
                       $minload = $itogTotalLoad;
                       $managerInfo = array("name"=>$nameManager,"load"=>$minload);
                    }                 
                 
                }
                //echo $nameManager . $itogTotalLoad . '<br>';
                 // print_r ($managerInfo);
                return $managerInfo;
        }



        public function showManagersSortByload() {
            $sortloadArray = array();
			$sql = "SELECT manager FROM projects WHERE  company = :nameCompany";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
			$stmt->execute();
            $stmt->execute();
            while($row = $stmt->fetch())               
             {                                       
                    
                     $nameManager = $row['manager'];  
                     $this->setnameManager($nameManager);                 
                     $ManagerLoad  =  $this->checkManagerTotalLoad();
                     $ManagerArray = array("load"=>$ManagerLoad, "name"=>$nameManager);
                     array_push($sortloadArray, $ManagerArray);
                     
                    
                }
                asort($sortloadArray);
                return  $sortloadArray;

             
        }

        public function changeManagersAndLoad(){
            $sql = "UPDATE zapros SET manager = :newmanager  WHERE  kompany = :nameCompany AND manager = :nameManager AND id = :id";
            $stmt = $this->dbConn->prepare($sql);
            
            $stmt->bindParam(":id", $this->id);
            $stmt->bindParam(":newmanager", $this->NewManager);
            $stmt->bindParam(":nameCompany", $this->nameCompany);
            $stmt->bindParam(":nameManager", $this->nameManager);              
            $stmt->execute();            
            return true;
        }


        public function checkInWhatCompaniesManagerInZapros() {
            $sql = "SELECT 	kompany FROM zapros WHERE  manager = :nameManager";
            $stmt = $this->dbConn->prepare($sql);            
            $stmt->bindParam(":nameManager", $this->nameManager);
            $stmt->execute();
            $checkInWhatCompan = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $checkInWhatCompan;
                               
        }


        public function showLevelZapros() {
			$sql = "SELECT level_zapros FROM zapros WHERE  id = :id";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":id", $this->id);
			$stmt->execute();
            $projectArray = $stmt->fetch(PDO::FETCH_ASSOC);
            return $projectArray;
        }
       

        public function checkExistaManagerInProject() {
			$sql = "SELECT manager FROM projects WHERE  company = :company";
            $stmt = $this->dbConn->prepare($sql);
            $stmt->bindParam(":company", $this->nameCompany);
			$stmt->execute();
            $projectArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($projectArray)) {
                return true;               
            }
            else
                return false;  
        }
    }


    
  