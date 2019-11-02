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
}  
?>