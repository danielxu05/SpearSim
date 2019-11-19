<?php
/**
  * 
  */
include 'class.attacker.php';
class Email
  {
  	private $Attacker;

  	private $Trial;#current Trial 

  	private $Cost;

  	private $Gain;

  	private $Edit;

  	private $Templete;

  	#private captital? 

  	private $Subject;

  	private $EmailCont;

  	private $SubjectEdit;

  	private $BodyEdit;

  	private $KeyStroke;

  	private $Practice_I;

  	private $Status; 

  	private $AttackStartTS; #AttackStartTimeStamp

  	private $AttackFinishTS; #AttackFinishTimeStamp

  	function __construct($Attacker,$Templete,$Practice_I,$Status,$AttackStartTS)
  	{
  		$this->Attacker = $Attacker;
  		$this->Trial = $Attacker->getTrial();
  		$this->Templete = $Templete;
  		$this->Practice_I = $Practice_I;
  		$this->Status = $Status;
  	}

  	public function getAttacker(){
		return $this->Attacker;
	}

	public function getTrial(){
		return $this->Trial;
	}

	public function setTrial($Trial){
		$this->Trial = $Trial;
	}

	public function getCost(){
		return $this->Cost;
	}

	public function setCost($Cost){
		$this->Cost = $Cost;
	}

	public function getGain(){
		return $this->Gain;
	}

	public function setGain($Gain){
		$this->Gain = $Gain;
	}

	public function getEdit(){
		return $this->Edit;
	}

	public function setEdit($Edit){
		$this->Edit = $Edit;
	}

	public function getTemplete(){
		return $this->Templete;
	}

	public function setTemplete($Templete){
		$this->Templete = $Templete;
	}

	public function getSubject(){
		return $this->Subject;
	}

	public function setSubject($Subject){
		$this->Subject = $Subject;
	}

	public function getEmailCont(){
		return $this->EmailCont;
	}

	public function setEmailCont($EmailCont){
		$this->EmailCont = $EmailCont;
	}

	public function getSubjectEdit(){
		return $this->SubjectEdit;
	}

	public function setSubjectEdit($SubjectEdit){
		$this->SubjectEdit = $SubjectEdit;
	}

	public function getBodyEdit(){
		return $this->BodyEdit;
	}

	public function setBodyEdit($BodyEdit){
		$this->BodyEdit = $BodyEdit;
	}

	public function getKeyStroke(){
		return $this->KeyStroke;
	}

	public function setKeyStroke($KeyStroke){
		$this->KeyStroke = $KeyStroke;
	}

	public function getPractice_I(){
		return $this->Practice_I;
	}

	public function setPractice_I($Practice_I){
		$this->Practice_I = $Practice_I;
	}

	public function getStatus(){
		return $this->Status;
	}

	public function setStatus($Status){
		$this->Status = $Status;
	}

	public function getAttackStartTS(){
		return $this->AttackStartTS;
	}

	public function setAttackStartTS($AttackStartTS){
		$this->AttackStartTS = $AttackStartTS;
	}

	public function getAttackFinishTS(){
		return $this->AttackStartTS;
	}

	public function setAttackFinishTS($AttackFinishTS){
		$this->AttackFinishTS = $AttackFinishTS;
	}

	public function checkAttackersql(){
	    #check the attacker; 
	    $db = Database::getInstance();
	    $conn = $db->getConnection(); 
	    $sql = "SELECT * FROM Spear_Phishing WHERE UserID = '".$this->Attacker->getUserID()."' AND Trial ='". $this->Trial ."';";
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
	      echo "1";
	      $sql = $this->genSQLUdt();
	    }else{
	      echo "2";
	      $sql = $this->genSQLIN();
	    }
	    echo $sql;
	    $conn->query($sql);
  	}

  	private function genSQLIN(){
		$array = get_object_vars($this);
		var_dump($array);
		unset($array['Attacker']);#to eliminate element from array
		unset($array['Role']);#to eliminate element from array
		$array['UserID'] = $this->Attacker->getUserID();
		#var_dump($array);
		echo "<br>";
		$part1 = "INSERT INTO `Spear_Phishing`";
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
		$array = get_object_vars($this);
		unset($array['Role']);#to eliminate element from array
		unset($array['Attacker']);#to eliminate element from array
		var_dump($array);
		echo "<br>";
		$part1 = "UPDATE `Spear_Phishing` SET";
		$query = '';
		foreach ($array as $key => $value) {
		  $query = $query." ".$key." = '".$value."',";
		}
		$sql = $part1.' '.substr($query, 0,-1)." WHERE UserID = '".$this->Attacker->getUserID()."'";
		return $sql;
	}
}
?>