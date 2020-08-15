<?php 
// include 'Session.php';
//include 'DbConnection.php';

class Task
{
	private $db;
	
	function __construct()
	{
		$this->db = new DbConnection();
	}

	public  function createTask($data){
		$id = $data['id'];
		$task_name = $data['task_name'];

		if($task_name == "" OR $id == ""){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fields must not be Empty</div>";
			return $msg;

		}

		if(strlen($task_name) < 3 ){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Task name is too short</div>";
			return $msg;

		}

		$sql = "INSERT INTO tasks (task_name,user_id) 
		VALUES (:task_name, :user_id)";
		$query = $this->db->pdo->prepare($sql);

		$query->bindValue(':task_name', $task_name);
		$query->bindValue(':user_id', $id);
		
		$result = $query->execute();

		if(isset($result)){
			$msg = "<div class='alert alert-success'><strong>Success !</strong> Task Assigned successfully.</div>";
			return $msg;

		}else{
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Task Assign failed.</div>";
			return $msg;

		}



	}

	public function getAllTasks(){
		$sql = "SELECT * FROM tasks ORDER BY id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;

	}

	public function getSingleUserTask(){
		// $id = (int)Session::get('id');
		$sql = "SELECT * FROM tasks WHERE user_id=:user_id";
		$query = $this->db->pdo->prepare($sql);

		$query->bindValue(':user_id', Session::get('id'));
		$query->execute();
		$result = $query->fetchAll();
		return $result;

	}

	public  function getEmployees(){
		$sql = "SELECT id,full_name FROM users ORDER BY id DESC";
		$query = $this->db->pdo->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;

	}

	public function setTimeline($id,$data){

		$start_time = $data['start_time'];
		$end_time = $data['end_time'];

		if($start_time == "" OR $end_time == ""){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fields must not be Empty</div>";
			return $msg;

		}

		$sql = "UPDATE tasks SET start_time=:start_time,end_time=:end_time  WHERE id=:id";

		$query = $this->db->pdo->prepare($sql);

		$query->bindValue(':start_time', $start_time);
		$query->bindValue(':end_time', $end_time);
		$query->bindValue(':id', $id);
		
		$result = $query->execute();

		if(isset($result)){
			$msg = "<div class='alert alert-success'><strong>Success !</strong> Set timeline successfully.</div>";
			return $msg;

		}else{
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Timeline Assign failed.</div>";
			return $msg;

		}
	}
}


 ?>