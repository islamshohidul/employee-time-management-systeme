<?php 

	include_once 'Session.php';
	include 'DbConnection.php';


class User
{
	private $db;
	
	function __construct()
	{
		$this->db = new DbConnection();
	}

	public function register($data){

		$user_name =  $data['user_name'];
		$full_name = $data['full_name'];
		$email = $data['email'];
		$row_pass = "admin123";
		$password = md5($row_pass);

		$checkEmail = $this->emailCheck($email);

		if($user_name == "" OR $full_name == "" OR $email == ""){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fields must not be Empty</div>";
			return $msg;

		}

		if(strlen($user_name) < 3 ){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Username is too short</div>";
			return $msg;

		}elseif(preg_match('/[^a-z0-9_-]+/i', $user_name)){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Username should contain only alphanumerical, undersocre and dash.</div>";
			return $msg;

		}

		if(strlen($full_name) <3 ){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Name is too short</div>";
			return $msg;

		}elseif(preg_match('/[^a-z0-9_-]+/i', $full_name) ){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Username should contain only alphanumerical, undersocre and dash.</div>";
			return $msg;

		}
		if($checkEmail==true){

			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Email Already Exist</div>";
			return $msg;


		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Email is invalide.</div>";
			return $msg;

		}
		//$now = NOW();
		$sql = "INSERT INTO users (full_name,user_name,email,password,created_at) 
		VALUES (:full_name, :user_name,:email,:password,now())";
		$query = $this->db->pdo->prepare($sql);

		$query->bindValue(':full_name', $full_name);
		$query->bindValue(':user_name', $user_name);
		$query->bindValue(':email', $email);
		$query->bindValue(':password', $password);
		
		$result = $query->execute();

		if(isset($result)){
			$msg = "<div class='alert alert-success'><strong>Success !</strong> User register successfully.</div>";
			return $msg;

		}else{
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Regestration failed.</div>";
			return $msg;

		}



	}

	public function emailCheck($email){
		$sql = "SELECT email FROM users WHERE email=:email ";
		$query = $this->db->pdo->prepare($sql);

		$query->bindValue(':email', $email);
		$query->execute();

		if($query->rowcount() >0 ){
			return true;

		}else{
			return false;

		}


	}

	public function getUser($email,$password){
		$sql = "SELECT * FROM users WHERE email=:email AND password=:password LIMIT 1";
		$query = $this->db->pdo->prepare($sql);
		$query->bindValue(':email', $email);
		$query->bindValue(':password', $password);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_OBJ);
		return $result; 



	}


	public function login($data){

		$email = $data['email'];
		$password = md5($data['password']);

		$checkEmail = $this->emailCheck($email);

		if($email == "" OR $password == ""){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fields must not be Empty</div>";
			return $msg;

		}

		if($checkEmail==false){

			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Email Address not Exist</div>";
			return $msg;


		}

		if(filter_var($email, FILTER_VALIDATE_EMAIL)==false){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Email is invalide.</div>";
			return $msg;

		}

		$result = $this->getUser($email,$password);

		if(isset($result)){
			Session::init();

			Session::set("login",true);
			Session::set("id", $result->id);
			Session::set("user_name", $result->user_name);
			Session::set("is_pass_set",$result->is_password_set);
			Session::set("is_admin", $result->is_admin);
			Session::set('msg', "<div class='alert alert-success'><strong>Success!</strong> Logged in successfully!</div>");

			if (Session::get("is_pass_set")==0 && Session::get("is_admin")==0) {
				header("Location: SetPass.php");
				
			}elseif(Session::get("is_admin")==1) {
				header("Location: index.php");
			}elseif (Session::get("is_pass_set")==1) {
				header("Location: index.php");
			}

			


		}else{
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Data not found.</div>";
			return $msg;

		}

	}
}

?>