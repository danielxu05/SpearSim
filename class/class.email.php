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

  	private $Goal; 

  	private $Subject;

  	private $EmailCont;

  	private $SubjectEdit;

  	private $BodyEdit;

  	private $KeyStroke;

  	private $Practice_I;

  	private $Status; 

  	private $AttackStartTS; #AttackStartTimeStamp

  	private $AttackFinishTS; #AttackFinishTimeStamp

  	private $Deadline;

  	private $Positive;

  	private $Negative;

  	private $Authority;

  	private $Friend;

  	private $Interest;

  	private $Failure;

  	private $Deal;

  	private $IllMaterial;

  	private $IllGains;

  	private $Oppotunity;

  	private $RHelp;

  	private $OHelp;

  	private $Other;

  	private $Self_eval;

  	private $TargetID;


  	function __construct($Attacker,$Trial,$Status)
  	{
  		$this->Attacker = $Attacker;
  		$this->Trial = $Trial;
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

	public function getGoal(){
		return $this->Goal;
	}

	public function setGoal($Goal){
		$this->Goal = $Goal;
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

	public function getDeadline(){
		return $this->Deadline;
	}

	public function setDeadline($Deadline){
		$this->Deadline = $Deadline;
	}

	public function getPositive(){
		return $this->Positive;
	}

	public function setPositive($Positive){
		$this->Positive = $Positive;
	}

	public function getNegative(){
		return $this->Negative;
	}

	public function setNegative($Negative){
		$this->Negative = $Negative;
	}

	public function getAuthority(){
		return $this->Authority;
	}

	public function setAuthority($Authority){
		$this->Authority = $Authority;
	}

	public function getFriend(){
		return $this->Friend;
	}

	public function setFriend($Friend){
		$this->Friend = $Friend;
	}

	public function getInterest(){
		return $this->Interest;
	}

	public function setInterest($Interest){
		$this->Interest = $Interest;
	}

	public function getFailure(){
		return $this->Failure;
	}

	public function setFailure($Failure){
		$this->Failure = $Failure;
	}

	public function getDeal(){
		return $this->Deal;
	}

	public function setDeal($Deal){
		$this->Deal = $Deal;
	}

	public function getIllGains(){
		return $this->IllGains;
	}

	public function setIllGains($IllGains){
		$this->IllGains = $IllGains;
	}

	public function getIllMaterial(){
		return $this->IllMaterial;
	}

	public function setIllMaterial($IllMaterial){
		$this->IllMaterial = $IllMaterial;
	}

	public function getOppotunity(){
		return $this->Oppotunity;
	}

	public function setOppotunity($Oppotunity){
		$this->Oppotunity = $Oppotunity;
	}

	public function getRHelp(){
		return $this->RHelp;
	}

	public function setRHelp($RHelp){
		$this->RHelp = $RHelp;
	}

	public function getOHelp(){
		return $this->OHelp;
	}

	public function setOHelp($OHelp){
		$this->OHelp = $OHelp;
	}

	public function getOther(){
		return $this->Other;
	}

	public function setOther($Other){
		$this->Other = $Other;
	}

	public function getSelf_eval(){
		return $this->Self_eval;
	}

	public function setSelf_eval($Self_eval){
		$this->Self_eval = $Self_eval;
	}

	public function getTargetID(){
		return $this->TargetID;
	}

	public function setTargetID($TargetID){
		$this->TargetID = $TargetID;
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

  	public function getTrialCont($Trial){
  		$db = Database::getInstance();
	    $conn = $db->getConnection(); 
	    $sql = "SELECT * FROM Spear_Phishing WHERE UserID = '".$this->Attacker->getUserID()."' AND Trial ='". $Trial ."';";
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
	    $conn->query($sql);
  	}

  	private function genSQLIN(){
		$array = get_object_vars($this);
		var_dump($array);
		unset($array['Attacker']);#to eliminate element from array
		unset($array['Role']);#to eliminate element from array
		$array['UserID'] = $this->Attacker->getUserID();
		#var_dump($array);
		$part1 = "INSERT INTO `Spear_Phishing`";
		$keys = "";
		$values = "";
		foreach ($array as $key => $value) {
			$keys = $keys." ".$key.",";
			$values = $values."'".$value."',";
		}
		$sql = $part1.'('.substr($keys, 0, -1).') VALUES ('.substr($values, 0,-1).');';
		echo $sql;
		return $sql;
  	}

	private function genSQLUdt(){
		$array = get_object_vars($this);
		var_dump($array);

		unset($array['Role']);#to eliminate element from array
		unset($array['Attacker']);#to eliminate element from array
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