<?php
include 'class.user.php';
class Rater extends User
  {
    private $AttackerID;
    private $Trial;
    private $Enduser;
    private $Degree;

    private $Q1;
    private $Q2;
    private $Q3;
    private $Q4;
    private $Debrifing;

  	function __construct($ID)
  	{
      parent::__construct($ID,'Rater');
      $this->Trial = 0;
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $sql = 'SELECT * from GroupRel WHERE`UserID1` = "'.$this->getUserID().'" or `UserID2` = "'.$this->getUserID().'" or `UserID3` = "'.$this->getUserID().'"';
      $result = $conn->query($sql)->fetch_assoc();
      $this->setGroupID($result['GroupID']);
      $this->AttackerID=$result['AttackerID'];
      if($result['UserID1']==$this->getUserID()){
        $this->Enduser = 'User1';
      }elseif($result['UserID2']==$this->getUserID()){
        $this->Enduser = 'User2';
      }elseif($result['UserID3']==$this->getUserID()){
        $this->Enduser = 'User3';
      }
    }
    
    public function setQ1($Q1){
      $this->Q1 = $Q1;
    }

    public function setQ2($Q2){
      $this->Q2 = $Q2;
    }

    public function setQ3($Q3){
      $this->Q3 = $Q3;
    }

    public function setQ4($Q4){
      $this->Q4 = $Q4;
    }

    public function getEnduser(){
      return $this->Enduser;
    }

    public function getTrial(){
      return $this->Trial;
    }

    public function nextTrial(){
      $this->Trial = $this->Trial + 1;
    }

  	public function getAttackerID(){
  		return $this->AttackerID;
    }

    public function getDegree(){
      return $this->Degree;
    }

    public function setDegree($Degree){
      $this->Degree= $Degree;
    }

    public function setDebrifing($Debrifing){
      $this->Debrifing = $Debrifing;
    }
    
    public function getProfile(){
      $sql = "Select * from enduserprofile where ID ='".$this->Enduser."'";
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $result = $conn->query($sql);
      return $result->fetch_assoc();
    }

  	public function checkStatus(){
	    #check the attacker; 
	    $db = Database::getInstance();
	    $conn = $db->getConnection(); 
      $sql = "SELECT * FROM Spear_Phishing 
        WHERE `TargetID` = '".$this->getUserID()."' and Status =0
        ORDER BY AttackFinishTS";
      $result = $conn->query($sql);
	    return $result;
  	}

    public function checkRater(){
      #check the attacker; 
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $sql = "SELECT UserID FROM Rater WHERE UserID = '".$this->getUserID()."';";
      $result = $conn->query($sql);
      #$result = 1;
      return $result;
    }

    public function updateTrial(){
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $sql = 'UPDATE Rater SET Trial = "'.$this->Trial.'"WHERE UserID = "'.$this->getUserID().'"';
      $conn->query($sql);
    }
        
    public function insertDB(){
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $result = $this->checkRater();
      if ($result->num_rows>0){
        $sql = $this->genSQLUdt();
      }else{
        $sql = $this->genSQLIN();
      }
      if (!$conn->query($sql)) {
        echo('There is something wrong here. Please take a screenshot of the error information and send to brics@uw.edu. Thank you.<br>');
          printf("Error: %s\n", $conn->error);
      }
      $this->updateTime();
    }


  private function genSQLIN(){
		$array = parent::toArray();
		$array = array_merge($array,get_object_vars($this));
		#var_dump($array);
		//unset($array['Trial']);#to eliminate element from array
		unset($array['Role']);#to eliminate element from array
		#var_dump($array);
		$part1 ='INSERT INTO '.$this->getRole();
		$keys = "";
		$values = "";
		foreach ($array as $key => $value) {
		  $keys = $keys." ".$key.",";
		  $values = $values."'".$value."',";
		}
		$sql = $part1.'('.substr($keys, 0, -1).') VALUES ('.substr($values, 0,-1).');';
		return $sql;
	  }
	
	  private function genSQLUdt(){
		$array = parent::toArray();
		$array = array_merge($array,get_object_vars($this));
	//	unset($array['Trial']);#to eliminate element from array
		unset($array['Role']);#to eliminate element from array
		unset($array['UserID']);#to eliminate element from array
		$part1 = "UPDATE ".$this->getRole()." SET";
		$query = '';
		foreach ($array as $key => $value) {
		  $query = $query." ".$key." = '".$value."',";
		}
		$sql = $part1.' '.substr($query, 0,-1)." WHERE UserID = '".$this->getUserID()."'";
		return $sql;
	  }

}  
?>