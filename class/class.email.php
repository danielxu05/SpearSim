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
	  
	private $LoadTS;

	private $ProfileTS;

	private $SubmitTS;

  	private $Offer;

  	private $Followup;

  	private $Threaten;

  	private $Failure;

  	private $Authority;

  	private $Peers;

  	private $Time;

  	private $Pretend;

  	private $Interest;

	private $Other;
	  
  	private $Self_eval;

	private $Tone;

	private $Impersonation;

	private $Personal_;

	private $Professional_;

	private $Family_;

	private $Interest_;

	private $User_info;

	private $TargetID;
	
	private $NumEdit;


  	function __construct($Attacker,$Trial,$Status)
  	{
  		$this->Attacker = $Attacker;
  		$this->Trial = $Trial;
  		$this->Status = $Status;
  	}

	  public function setProfileTS($ProfileTS){
		  $this->ProfileTS = $ProfileTS;
	  }
	  public function setLoadTS($LoadTS){
		$this->LoadTS = $LoadTS;
	}


	public function setSubmitTS($SubmitTS){
		$this->SubmitTS = $SubmitTS;
	}

	public function setNumEdit($NumEdit){
		$this->NumEdit = $NumEdit;
	}


	public function setUser_info($User_info){
		$this->User_info=$User_info;
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
	public function getOffer(){
		return $this->Offer;
	}

	public function setOffer($Offer){
		$this->Offer = $Offer;
	}

	public function getFollowup(){
		return $this->Followup;
	}

	public function setFollowup($Followup){
		$this->Followup = $Followup;
	}

	public function getThreaten(){
		return $this->Threaten;
	}

	public function setThreaten($Threaten){
		$this->Threaten = $Threaten;
	}

	public function getFailure(){
		return $this->Failure;
	}

	public function setFailure($Failure){
		$this->Failure = $Failure;
	}

	public function getAuthority(){
		return $this->Authority;
	}

	public function setAuthority($Authority){
		$this->Authority = $Authority;
	}

	public function getPeers(){
		return $this->Peers;
	}

	public function setPeers($Peers){
		$this->Peers = $Peers;
	}

	public function getTime(){
		return $this->Time;
	}

	public function setTime($Time){
		$this->Time = $Time;
	}

	public function getPretend(){
		return $this->Pretend;
	}

	public function setPretend($Pretend){
		$this->Pretend = $Pretend;
	}

	public function getInterest(){
		return $this->Interest;
	}

	public function setInterest($Interest){
		$this->Interest = $Interest;
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

	public function getTone(){
		return $this->Tone;
	}

	public function setTone($Tone){
		$this->Tone = $Tone;
	}

	public function getTargetID(){
		return $this->TargetID;
	}

	public function setTargetID($TargetID){
		$this->TargetID = $TargetID;
	}

	public function getImpersonation(){
		return $this->Impersonation;
	}

	public function setImpersonation($Impersonation){
		$this->Impersonation = $Impersonation;
	}

	public function getPersonal_(){
		return $this->Personal_;
	}

	public function setPersonal_($Personal_){
		$this->Personal_ = $Personal_;
	}

	public function getProfessional_(){
		return $this->Professional_;
	}

	public function setProfessional_($Professional_){
		$this->Professional_ = $Professional_;
	}

	public function getFamily_(){
		return $this->Family_;
	}

	public function setFamily_($Family_){
		$this->Family_ = $Family_;
	}

	public function getInterest_(){
		return $this->Interest_;
	}

	public function setInterest_($Interest_){
		$this->Interest_ = $Interest_;
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
	    $sql = "SELECT Subject,EmailCont FROM Spear_Phishing WHERE UserID = '".$this->Attacker->getUserID()."' AND Trial ='". $Trial ."';";
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
		if(!$conn->query($sql)){
			printf("Connection failed: %s\n", $conn->error, $SQL);
			exit();
		}
  	}

  	private function genSQLIN(){
		$array = get_object_vars($this);
		unset($array['Attacker']);#to eliminate element from array
		unset($array['Role']);#to eliminate element from array
		$array['UserID'] = $this->Attacker->getUserID();
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