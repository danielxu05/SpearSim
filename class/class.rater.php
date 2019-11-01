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

  	function __construct($ID)
  	{
  		parent::__construct($ID,'Rater');
 		$this->setTargetAttackerID();
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
		echo "ssssss";

  		$sql = "SELECT AttackerID FROM Rater Where UserID = '".$this->getUserID()."'";
  		echo $sql;
  		$result = $conn->query($sql);
        if ($result->num_rows>0){
        	$this->TargetAttackerID = $result->fetch_assoc()['AttackerID'];
        	echo "set";
        }else{
        	echo "No target attacker to evaluate;";
        }
  	}

  	public function getTargetAttackerID(){
  		return $this->TargetAttackerID;
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