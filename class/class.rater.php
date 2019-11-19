<?php
/**
  * 
  */
include 'class.database.php';
include 'class.user.php';
class Rater extends User
  {
  	private $Spear_eval_num = 0;
  	private $Non_Spear_eval_num = 0;
  	private $TargetAttackerID;
    private $EmailList;

  	function __construct($ID)
  	{
  	   parent::__construct($ID,'Rater');
 		   $this->setTargetAttackerID();
       $this->setEmailList();
  		# code...
  	}

  	public function getSpear_eval_num(){
  		return $this->Spear_eval_num;
  	}

  	public function NextSpear_eval_num(){
  		$this->Spear_eval_num = $this->Spear_eval_num + 1;
  	}

  	public function getNon_Spear_eval_num(){
  		return $this->Non_Spear_eval_num;
  	}

  	public function NextNon_Spear_eval_num(){
  		$this->Non_Spear_eval_num = $this->Non_Spear_eval_num + 1;
  	}

  	public function setTargetAttackerID(){
      #get eval attacker;
  		$db = Database::getInstance();
		  $conn = $db->getConnection(); 
  		$sql = "SELECT AttackerID FROM Rater Where UserID = '".$this->getUserID()."'";
  		$result = $conn->query($sql);
      if ($result->num_rows>0){
      	$this->TargetAttackerID = $result->fetch_assoc()['AttackerID'];
      }else{
      	echo "No target attacker to evaluate;";
      }
  	}

  	public function getTargetAttackerID(){
  		return $this->TargetAttackerID;
  	}

    public function setEmailList(){
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $sql = "SELECT EmailList from Rater WHERE UserID='".$this->getUserID()."'";
      #echo $sql;
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
      $EmailIDs = explode(",", $row['EmailList']);
      #var_dump($EmailIDs);
      $this->EmailList = $EmailIDs;
    }

    public function getEmailList(){
      return $this->EmailList;
    }

  	public function checkStatus(){
	    #check the attacker; 
	    $db = Database::getInstance();
	    $conn = $db->getConnection(); 
      $sql = "SELECT * FROM Spear_Phishing 
        WHERE `UserID` = '".$this->TargetAttackerID."' and Status =0
        ORDER BY AttackFinishTS";
      $result = $conn->query($sql);
	    return $result;
  	}

    public function checkAttackersql(){
      #check the attacker; 
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $sql = "SELECT UserID FROM Rater WHERE UserID = '".$this->getUserID()."';";
      $result = $conn->query($sql);
      #$result = 1;
      #print_r($conn);
      return $result;
    }
    #insert rater into database;and auto generate email list; 
    /*
    public function insertDB(){
      $db = Database::getInstance();
      $conn = $db->getConnection(); 
      $result = $this->checkAttackersql();
      print_r($result);
      if ($result->num_rows>0){
        $sql = $this->genSQLUdt();
      }else{
        $sql = $this->genSQLIN();
      }
      $conn->query($sql);
    }

  private function genSQLIN(){
    $array = parent::toArray();
    $array = array_merge($array,get_object_vars($this));
    #var_dump($array);
    unset($array['Trial']);#to eliminate element from array
    unset($array['Role']);#to eliminate element from array
    #var_dump($array);
    echo "<br>";
    $part1 = "INSERT INTO `Rater`";
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
    $part1 = "UPDATE `Rater` SET";
    $query = '';
    foreach ($array as $key => $value) {
      $query = $query." ".$key." = '".$value."',";
    }
    $sql = $part1.' '.substr($query, 0,-1)." WHERE UserID = '".$this->getUserID()."'";
    return $sql;
  }*/

}  
?>