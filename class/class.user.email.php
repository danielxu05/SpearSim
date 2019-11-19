<?php

/**
   * 
   */
include 'class.rater.php';
class EmailClassification 
  {
  	private $RaterID;

  	private $PhishID;

    private $spearIndicator;

    private $PairID;

    private $Response;

    private $Confidence;

    private $important;

    private $workmail;

    private $social;

    private $authority;

    private $status;

    private $marketing;

    private $personal;

    private $spam;

    private $job;

    private $deadline;

    private $positive;

    private $negative;

    private $request;

    private $offer;

    private $grammar;

  	private $clear;

    private $other;

    private $Starttime;

    private $Endtime;

  function __construct($RaterID)
  {
  	$this->RaterID = $RaterID;
  }

  public function setspearIndicator($spearIndicator){
    $this->spearIndicator = $spearIndicator;
  }

  public function getRaterID(){
    return $this->Rater;
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

  public function getPairID(){
    return $this->PairID;
  }

  public function setPairID($PairID){
    $this->PairID = $PairID;
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

  public function getWorkmail(){
    return $this->workmail;
  }

  public function setWorkmail($workmail){
    $this->workmail = $workmail;
  }

  public function getSocial(){
    return $this->social;
  }

  public function setSocial($social){
    $this->social = $social;
  }

  public function getAuthority(){
    return $this->authority;
  }

  public function setAuthority($authority){
    $this->authority = $authority;
  }

  public function getStatus(){
    return $this->status;
  }

  public function setStatus($status){
    $this->status = $status;
  }

  public function getMarketing(){
    return $this->marketing;
  }

  public function setMarketing($marketing){
    $this->marketing = $marketing;
  }

  public function getPersonal(){
    return $this->personal;
  }

  public function setPersonal($personal){
    $this->personal = $personal;
  }

  public function getSpam(){
    return $this->spam;
  }

  public function setSpam($spam){
    $this->spam = $spam;
  }

  public function getJob(){
    return $this->job;
  }

  public function setJob($job){
    $this->job = $job;
  }

  public function getDeadline(){
    return $this->deadline;
  }

  public function setDeadline($deadline){
    $this->deadline = $deadline;
  }

  public function getPositive(){
    return $this->positive;
  }

  public function setPositive($positive){
    $this->positive = $positive;
  }

  public function getNegative(){
    return $this->negative;
  }

  public function setNegative($negative){
    $this->negative = $negative;
  }

  public function getRequest(){
    return $this->request;
  }

  public function setRequest($request){
    $this->request = $request;
  }

  public function getOffer(){
    return $this->offer;
  }

  public function setOffer($offer){
    $this->offer = $offer;
  }

  public function getGrammar(){
    return $this->grammar;
  }

  public function setGrammar($grammar){
    $this->grammar = $grammar;
  }

  public function getClear(){
    return $this->clear;
  }

  public function setClear($clear){
    $this->clear = $clear;
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
    $conn->query($sql);
    return $sql;
  }

  }  
  ?>