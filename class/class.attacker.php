<?php
/**
  * 
  */
include 'class.user.php';
class Attacker extends User
{

	private $ProfileType;
  private $Trial=1;
  private $TargetID1;
  private $TargetID2;
  private $TargetID3;
  private $BNatLang;
  private $Q1;
  private $Q2;
  private $Q3;

  private $NatLang;#native language for user

  private $LangProf; #language proficency 
  
	function __construct($ID)
	{
		parent::__construct($ID,'Attacker');
    $this->setProfileType();
#    $this->setGroupID($GroupID);
#    $this->setTargets();
    #$this->TargetID1 = $TargetID1;
    #$this->TargetID2 = $TargetID2;
    #$this->TargetID3 = $TargetID3;
    #set profile_type;
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


  public function setTargets(){
    $db = Database::getInstance();
    $conn = $db->getConnection(); 
    $sql = 'SELECT * from GroupRel WHERE`AttackerID` = "'.$this->getUserID().'"';
    $result = $conn->query($sql)->fetch_assoc();
    $this->TargetID1 = $result['UserID1'];
    $this->TargetID2 = $result['UserID2'];
    $this->TargetID3 = $result['UserID3'];
    $this->setGroupID($result['GroupID']);
    $this->setEarn(1000);
  }

  public function setBNatLang($BNatLang){
    $this->BNatLang = $BNatLang;
  }
  public function setTargetID1($TargetID1){
    $this->TargetID1 = $TargetID1;
  }

  public function getTargetID1(){
    return $this->TargetID1;
  }

  public function setTargetID2($TargetID2){
    $this->TargetID2 = $TargetID2;
  }

  public function getTargetID2(){
    return $this->TargetID2;
  }

  public function setTargetID3($TargetID3){
    $this->TargetID3 = $TargetID3;
  }

  public function getTargetID3(){
    return $this->TargetID3;
  }


  public function nextTrial(){
    $num = $this->Trial;
    $this->Trial = $num + 1;
    $this->setEarn($this->getEarn()-100);
    return $this;
  }

  public function getTrial(){
    return $this->Trial;
  }

  public function getTargetprofile($ID){
    $ID= 'User'.strval($ID);
    $sql = "Select * from enduserprofile where ID ='".$ID."'";
    $db = Database::getInstance();
    $conn = $db->getConnection(); 
    $result = $conn->query($sql);
    return $result->fetch_assoc();
  }

  public function setNatLang($NatLang){
    $this->NatLang = $NatLang;
    return $this;
  }

  public function getNatLang(){
    return $this->NatLang;
  }

  public function setLangProf($LangProf){
    $this->LangProf = $LangProf;
    return $this;
  }

  public function getLangProf(){
    return $this->LangProf;
  }


  private function setProfileType(){
   /* $db = Database::getInstance();
    $conn = $db->getConnection(); 
    $type = array('1','2','3');
    $sql = "SELECT ProfileType,COUNT(ProfileType)AS Frequency 
            FROM Attacker 
            GROUP BY ProfileType
            ORDER BY COUNT(ProfileType)";
    $result = $conn->query($sql);

    if ($result->num_rows<3){
        $attack_type = $type[mt_rand(0,2)];
    }else {
      $attack_type = $result->fetch_assoc()['ProfileType'];
    }
    $this->ProfileType = $attack_type;
    */
    $this->ProfileType = '3';#set experinment condition
  }   

  public function getProfileType(){
    return $this->ProfileType;
  }

  public function checkAttackersql(){
    #check the attacker; 
    $db = Database::getInstance();
    $conn = $db->getConnection(); 
    $sql = "SELECT UserID FROM Attacker WHERE UserID = '".$this->getUserID()."';";
    $result = $conn->query($sql);
    #$result = 1;
    #print_r($conn);
    return $result;
  }

  public function insertDB(){
    $db = Database::getInstance();
    $conn = $db->getConnection(); 

    $result = $this->checkAttackersql();

    if ($result->num_rows>0){
      $sql = $this->genSQLUdt();
    }else{
      $sql = $this->genSQLIN();
    }    
#    print_r($sql);
    if (!$conn->query($sql)) {
      echo('There is something wrong here. Please take a screenshot of the error information and send to Daniel. Thank you.<br>');
        printf("Error: %s\n", $conn->error);
    }
#    $this->updateTime();
  }

  private function genSQLIN(){
		$array = parent::toArray();
		$array = array_merge($array,get_object_vars($this));
		#var_dump($array);
		unset($array['Trial']);#to eliminate element from array
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
		unset($array['Trial']);#to eliminate element from array
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


