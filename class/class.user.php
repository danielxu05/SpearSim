<?php
include 'class.database.php';
class User 
{
 	private $UserID;#Mturk User ID
 	
 	private $Role;

 	private $Age;#

 	private $Gender;

 	private $GroupID;#Mturk group ID

	private $Waittime;

	private $Starttime;

	private $last_active_time;

	private $mturkcredential;

	private $Earn=0;# Money user enrn

  	function __construct($UserID,$Role){
		$this->UserID = $UserID; 
		$this->Role = $Role; 	
		#$this->GroupID = $GroupID;
	}
	  
	public function setEarn($Earn){
		$this->Earn = $Earn;
	  }
	
	  public function getEarn(){
		return $this->Earn;
	  }

	public function setStarttime($Starttime){
		$this->Starttime = $Starttime;
	}

	public function setWaittime($Waittime){
		$this->Waittime = $Waittime;
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

  	public function setGroupID($GroupID){
  		$this->GroupID = $GroupID;
  	}

  	public function getGroupID(){
  		return $this->GroupID;
	  }
	  
  	public function toArray(){
  		return get_object_vars($this);
	}
	  
	public function setmturkcredential(){
		$time = new DateTime();
		$str = $this->getUserID().$time->format('Y-m-d H:i:s');
		$this->mturkcredential = substr(md5($str),0,6);
	}
	
	public function setReward(){
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		$sql2 = "SELECT * from `reward` WHERE UserID ='". $this->UserID."';";
		$browseresule = $conn->query($sql2);
		if ($browseresule->num_rows>0){
			return $browseresule->fetch_assoc();
		}else{
			$sql = "SELECT * FROM `reward` WHERE UserID = '' LIMIT 1";
			$result = $conn->query($sql);
			if ($result->num_rows==0){
				echo('We are running out of Tango card now. Please take a screenshot and send an email to brics@uw.edu. We will take your case sincerely');
			}else{
				$reward = $result->fetch_assoc();
				$sql1 = "UPDATE `reward` Set `UserID` = '".$this->UserID."' where PurID ='".$reward['PurID']."';";
				$conn->query($sql1); 
				return $reward;
			}
			
		}
	}

	public function getmturkcredential(){
		return $this->mturkcredential;
	}

	public function insertInfo($Email,$FN,$LN,$md5){
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		$sql = "INSERT INTO `student`(`EmailAddress`, `FirstName`, `LastName`, `UserID`,`Role`) VALUES ('". $Email ."','".$FN."','".$LN."','".$md5."','".$this->Role."');";
		$conn->query($sql);
	}

	public function updateTime(){
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		$checkself = $this->checkselfTime();
		if ($checkself){
			$time = new DateTime();
			$sql = 'UPDATE '.$this->Role.' SET last_active_time = "'.$time->getTimestamp().'"WHERE UserID = "'.$this->UserID.'"'; 
			$this->last_active_time= $time->getTimestamp();
			$conn->query($sql);
		}
		return $checkself;
	}

	public function checkselfTime(){
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		$sql = "SELECT last_active_time from ".$this->Role." WHERE UserID='".$this->UserID."'";
		$result = $conn->query($sql)->fetch_assoc();
		#5 minutus; then abort the user
		if($result['last_active_time']==''){
			return true;
		}
		if($this->Role =='Attacker'){
			if($this->getThreshold(20)>intval($result['last_active_time'])){#12
				$this->abortUsers(3);
				return false;
			}
		}elseif($this->Role =='Rater'){
			if($this->getThreshold(20)>intval($result['last_active_time'])){#10
				$this->abortUsers(3);
				return false;
			}
		}
		return true;
	}

	public function getThreshold($minutes){
		$time =  time()-$minutes * 60;
		#echo($time);
		return $time;
	}

	public function checkActive(){
		date_default_timezone_set('America/Los_Angeles');
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		$sql1 = 'SELECT UserID,last_active_time FROM Attacker 
		WHERE UserID in 
		(SELECT AttackerID as ID FROM GroupRel WHERE GroupID = "'.$this->GroupID.'")'; 

		$sql = 'SELECT UserID,last_active_time FROM Rater WHERE UserID in 
		(SELECT UserID1 FROM GroupRel WHERE GroupID = "'.$this->GroupID.'" 
		UNION ALL SELECT UserID2 FROM GroupRel WHERE GroupID = "'.$this->GroupID.'"  
		UNION ALL SELECT UserID3 FROM GroupRel WHERE GroupID = "'.$this->GroupID.'")'; 
		$result = $conn->query($sql)->fetch_all();
		$abortUser = array();
		$time = $this->getThreshold(20);#rater
		
		$date = date("Y-m-d H:i:s", $time);
		$threshold = strtotime($date);
		#echo '<BR>';
		#echo 'threshold:  '.$threshold.'   Time: '.$date;
		#echo '<BR>';
		foreach ($result as $times){
			$temp = intval($times[1]);
		#	echo(' User Name: '.$times[0].'     timestamp: '.$temp.' '.date("Y-m-d H:i:s", $temp).'<BR>');
			if ($threshold>$times[1]){
				#have user leave the game;
				array_push($abortUser,$times[0]);
			}
		}

		$result1 = $conn->query($sql1)->fetch_assoc();
		$time = $this->getThreshold(20);#attacker
		$date = date("Y-m-d H:i:s", $time);
		$threshold = strtotime($date);
		$temp = intval($result1['last_active_time']);
		#echo(' User Name: '.$result1['UserID'].'     timestamp: '.$temp.' '.date("Y-m-d H:i:s", $temp).'<BR>');
		if ($threshold>intval($result1['last_active_time'])){
			#have user leave the game;
			array_push($abortUser,$result1['UserID']);
		}

		if (count($abortUser)==0){
			return True;
		}else{
			$this->abortUsers(2);
			return false;
		}
	}

	public function abortUsers($status){
		#abort users;		
		$db = Database::getInstance();
		$conn = $db->getConnection(); 
		#null leaving the game 
		#0 in process
		#1 finish the game
		#2 abort because others leaving
		#3 abort because itself leaving
		$sql = 'UPDATE '.$this->Role.' SET Status = "'.$status.'" WHERE UserID = "'.$this->UserID.'"'; 
		$conn->query($sql);
		if ($status==1){
			# to end game page;
			if($this->Role=='Attacker'){
				echo "<script>self.location = 'ThankYou.php';</script>";
			}elseif ($this->Role=='Rater'){
				echo '<script>self.location = "./survey.php";</script>';
			}
		}elseif($status==2){
			#to sorry page;
			echo '<script>self.location = "../sorry1.php";</script>';
		}elseif($status==3){
			#to penalty page;cannot get any reward. 
			echo "<script>window.location.href = 'http://'+window.location.hostname+'/EmailMG/sorry2.html';</script>";
		}
	}
}
?>