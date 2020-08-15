<?php 

include 'DbConnection.php';
 
 
 class ClockInClockOut
 {
 	private $db;
 	
 	function __construct()
 	{
 		$this->db = new DbConnection();
 		
 	}

 	public function setEntryAndExitTime($data){

 		$type = $data['type'];
 		$time = $data['time'];

 		if($type == "" OR $time == ""){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fields must not be Empty</div>";
			return $msg;

		}

		$sql = "INSERT INTO employee_attendance (user_id,event_type,work_time,work_date ) 
		VALUES (:user_id, :event_type, :work_time, NOW())";
		$query = $this->db->pdo->prepare($sql);

		$query->bindValue(':user_id', Session::get('id'));
		$query->bindValue(':event_type', $type);
		$query->bindValue(':work_time', $time);

		
		$result = $query->execute();

		if(isset($result)){
			$msg = "<div class='alert alert-success'><strong>Success !</strong> Time Assigned successfully.</div>";
			return $msg;

		}else{
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Time Assign failed.</div>";
			return $msg;

		}




 	}
 }

 ?>