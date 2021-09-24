<?php

/**
   * 
   */
include 'class.rater.php';
#class file for email classification
class EmailClassification 
  {
  	private $RaterID;

  	private $PhishID;

    private $spearIndicator;

    private $Response;

    private $Confidence;

    private $important;

    private $action;

    private $information;


    private $project;

    private $meeting;

    private $deadline;


    private $spam;

    private $other;

    private $Starttime;

	private $Endtime;
	
	private $Result;

  function __construct($RaterID)
  {
  	$this->RaterID = $RaterID;
  }

  public function getRaterID(){
		return $this->RaterID;
	}

	public function setRaterID($RaterID){
		$this->RaterID = $RaterID;
	}

	public function getPhishID(){
		return $this->PhishID;
	}

	public function setPhishID($PhishID){
		$this->PhishID = $PhishID;
	}

	public function setResult($Result){
		$this->Result = $Result;
	}
	public function getspearIndicator(){
		return $this->spearIndicator;
	}

	public function setspearIndicator($spearIndicator){
		$this->spearIndicator = $spearIndicator;
	}

	public function getPairID(){
		return $this->PairID;
	}


	public function getResponse(){
		return $this->Response;
	}

	public function setResponse($Response){
		$this->Response = $Response;
	}

	public function getConfidence(){
		return $this->Confidence;
	}

	public function setConfidence($Confidence){
		$this->Confidence = $Confidence;
	}

	public function getImportant(){
		return $this->important;
	}

	public function setImportant($important){
		$this->important = $important;
	}

	public function getAction(){
		return $this->action;
	}

	public function setAction($action){
		$this->action = $action;
	}

	public function getInformation(){
		return $this->information;
	}

	public function setInformation($information){
		$this->information = $information;
	}

	public function getProject(){
		return $this->project;
	}

	public function setProject($project){
		$this->project = $project;
	}

	public function getMeeting(){
		return $this->meeting;
	}

	public function setMeeting($meeting){
		$this->meeting = $meeting;
	}

	public function getDeadline(){
		return $this->deadline;
	}

	public function setDeadline($deadline){
		$this->deadline = $deadline;
	}

	public function getSpam(){
		return $this->spam;
	}

	public function setSpam($spam){
		$this->spam = $spam;
	}

	public function getOther(){
		return $this->other;
	}

	public function setOther($other){
		$this->other = $other;
	}

	public function getStarttime(){
		return $this->Starttime;
	}

	public function setStarttime($Starttime){
		$this->Starttime = $Starttime;
	}

	public function getEndtime(){
		return $this->Endtime;
	}

	public function setEndtime($Endtime){
		$this->Endtime = $Endtime;
	}

  public function insertDB(){
    $db = Database::getInstance();
    $conn = $db->getConnection(); 
    $array = get_object_vars($this);
    $part1 = "INSERT INTO `UserClassification`";
    $keys = "";
    $values = "";
    foreach ($array as $key => $value) {
      $keys = $keys." ".$key.",";
      $values = $values."'".$value."',";
    }
	$sql = $part1.'('.substr($keys, 0, -1).') VALUES ('.substr($values, 0,-1).');';
    if (!$conn->query($sql)) {
      echo('There is something wrong here. Please take a screenshot of the error information and send to Daniel. Thank you.<br>');
        printf("Error: %s\n", $conn->error);
    }
    return $sql;
  }

  }  
  ?>