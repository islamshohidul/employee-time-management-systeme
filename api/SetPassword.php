<?php 
	include 'DbConnection.php';
	
	class SetPassword
	{
		private $db;
		function __construct()
		{
			$this->db = new DbConnection();
			
		}


		private  function checkPassWord($id,$old_pass){
			$password = md5($old_pass);

			$sql = "SELECT password FROM users WHERE id =:id AND password=:password ";
			$query = $this->db->pdo->prepare($sql);

			$query->bindValue(':id', $id);
			$query->bindValue(':password', $password);
			$query->execute();

			if($query->rowcount() >0 ){
				return true;

			}else{
				return false;

			}

		}

		public function setNewPassword($data){

			$old_pass = $data['old_password'];
			$new_pass = $data['password'];
			$user_id = Session::get('id');
			$is_pass_set = 1;
			$password = md5($new_pass);
			$check_pass = $this->checkPassWord($user_id,$old_pass);



			if($old_pass == "" OR $new_pass == ""){
			$msg = "<div class='alert alert-danger'><strong>Error !</strong> Fields must not be Empty</div>";
			return $msg;

			}

			
			if ($check_pass==false) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Password not exist</div>";
				return $msg;
			}

			if (strlen($new_pass)<6) {
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Password too short.</div>";
				return $msg;
			}

			$sql = "UPDATE users SET password=:password,is_password_set=:is_password_set  WHERE id=:id";

			$query = $this->db->pdo->prepare($sql);

			$query->bindValue(':id', $user_id);
			$query->bindValue(':password', $password);
			$query->bindValue(':is_password_set', $is_pass_set);
			$result = $query->execute();

			if(isset($result)){
				// $msg = "<div class='alert alert-success'><strong>Success !</strong> Set password successfully.</div>";
				// return $msg;
				header("Location: index.php");

			}else{
				$msg = "<div class='alert alert-danger'><strong>Error !</strong> Password Assign failed.</div>";
				return $msg;

			}

		}
	}

 ?>