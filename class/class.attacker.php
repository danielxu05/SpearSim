<?php
/**
  * 
  */
include 'class.database.php';
include 'class.user.php';
class Attacker extends User
{

	private $ProfileType;
  private $Trial=0;
  private $TargetID1;
  private $TargetID2;
  private $TargetID3;

	function __construct($ID,$TargetID1,$TargetID2,$TargetID3)
	{
		parent::__construct($ID,'Attacker');
    $this->setProfileType();
    $this->TargetID1 = $TargetID1;
    $this->TargetID2 = $TargetID2;
    $this->TargetID3 = $TargetID3;
    #set profile_type;
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
    return $this;
  }

  public function getTrial(){
    return $this->Trial;
  }

  private function setProfileType(){
    $db = Database::getInstance();
    $conn = $db->getConnection(); 
    #print_r($conn);
    $type = array('Facebook',"Twitter","Linkedin");
    $sql = "SELECT ProfileType,COUNT(ProfileType)AS Frequency 
            FROM Attacker 
            GROUP BY ProfileType
            ORDER BY COUNT(ProfileType)";
    $result = $conn->query($sql);
    if ($result->num_rows<=2){
        $attack_type = $type[mt_rand(0,2)];
    }else {
      $attack_type = $result->fetch_assoc()['ProfileType'];
    }
    $this->ProfileType = $attack_type;
    return $this;
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

  private function oldinsertDB(){
    #insert attacker information in to DB
    $result = $this->checkAttackersql();
    if ($result->num_rows>0){
      #the information existed already; update
      $sql2 = "UPDATE `Attacker` SET `ProfileType`='".$this->ProfileType."',`Age`='".$this->getAge()."',`Gender`='".$this->getGender()."',`Job`='".$this->getJob()."',`Personality`='".$this->getPersonality()."',`GroupID`='".$this->getGroupID()."',`Earn`='".$this->getEarn()."' WHERE UserID='".$this->getUserID()."';";
    }else{
      #the information not exist; insert
      $sql2 = "INSERT INTO `Attacker`(`UserID`, `ProfileType`, `Age`, `Gender`, `Job`, `Personality`, `GroupID`, `Earn`) VALUES ('".$this->getUserID()."','".$this->ProfileType."','".$this->getAge()."','".$this->getGender()."','".$this->getJob()."','".$this->getPersonality()."','".$this->getGroupID()."','".$this->getEarn()."');";
    }
    #$conn->query($sql2);
  }

  public function insertDB(){
    $db = Database::getInstance();
    $conn = $db->getConnection(); 
    $result = $this->checkAttackersql();
    print_r($result);
    if ($result->num_rows>0){
      echo "1";
      $sql = $this->genSQLUdt();
    }else{
      echo "2";
      $sql = $this->genSQLIN();
    }
    echo $sql;
    #$conn->query($sql);
  }

  private function genSQLIN(){
    $array = parent::toArray();
    $array = array_merge($array,get_object_vars($this));
    #var_dump($array);
    unset($array['Trial']);#to eliminate element from array
    unset($array['Role']);#to eliminate element from array
    #var_dump($array);
    echo "<br>";
    $part1 = "INSERT INTO `Attacker`";
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
    $part1 = "UPDATE `Attacker` SET";
    $query = '';
    foreach ($array as $key => $value) {
      $query = $query." ".$key." = '".$value."',";
    }
    $sql = $part1.' '.substr($query, 0,-1)." WHERE UserID = '".$this->getUserID()."'";
    return $sql;
  }
}
?>


