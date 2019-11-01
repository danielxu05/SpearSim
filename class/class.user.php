<?php
/**
  * 
  */
class User 
{
 	private $UserID;#Mturk User ID
 	
 	private $Role;

 	private $Age;#

 	private $Gender;

 	private $Job;

 	private $Personality;

 	private $GroupID;#Mturk group ID

 	private $Earn;# Money user enrn

 	private $NatLang;#native language for user

 	private $LangProf; #language proficency 

  	function __construct($UserID,$Role){#will add group ID in the future
  		$this->UserID = $UserID; 
  		$this->Role = $Role; 		# code...
  	}

  	public function getUserID(){
  		return $this->UserID;
  	}

  	public function getRole(){
  		return $this->Role;
  	}

  	public function setAge($Age){
  		$this->Age = $Age;
  		return $this;
  	}

  	public function getAge(){
  		return $this->Age;
  	}

  	public function setGender($Gender){
  		$this->Gender = $Gender;
  		return $this;
  	}

  	public function getGender(){
  		return $this->Gender;
  	}

  	public function setJob($Job){
  		$this->Job = $Job;
  		return $this;
  	}

  	public function getJob(){
  		return $this->Job;
  	}

  	public function setPersonality($Personality){
  		$this->Personality = $Personality;
  		return $this;
  	}

  	public function getPersonality(){
  		return $this->Personaility;
  	}
  	public function setGroupID($GroupID){
  		$this->GroupID = $GroupID;
  		return $this;
  	}

  	public function getGroupID(){
  		return $this->GroupID;
  	}
  	public function setEarn($Earn){
  		$this->Earn = $Earn;
  		return $this;
  	}

  	public function getEarn(){
  		return $this->Earn;
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

  	public function toString(){
  		$text = $this->Role." ".$this->UserID." Age: ". $this->Age." Gender: ".$this->Gender." Job:".$this->Job." Personality: ". $this->Personality." GroupID".$GroupID." Earn".$Earn;
  		return $text;
  	}

  	public function toArray(){
  		return get_object_vars($this);
  	}




}  ?>