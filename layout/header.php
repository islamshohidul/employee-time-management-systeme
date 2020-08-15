<?php 

$filePath = realpath(dirname(__FILE__));
include_once $filePath.'/../api/Session.php';
Session::init();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="style/bootstrap.min.js"></script>
</head>
<?php 
   if (isset($_GET['action'])=='logout' && $_GET['action']=="logout") {
   	 Session::destroy();
   }
?>
<body>

	<div class="container mb-4">

		<nav class="navbar navbar-expand-sm bg-light">
			<div class="nav-header">
				<a href="javascript:void(0)">Employee Management system</a>
			</div>
		  <ul class="navbar-nav ml-auto">
		  	<?php 
		  		$id = Session::get('id');
		  		$is_admin=Session::get('is_admin');
		  		$userLogin = Session::get('login');

		  		if($userLogin==true && $is_admin==1){


		  	?>
		  	<li class="nav-item">
		      <a class="nav-link" href="index.php">Task List</a>
		    </li>
		  	 <li class="nav-item">
		      <a class="nav-link" href="register.php">Register</a>
		    </li>
		  	<li class="nav-item">
		      <a class="nav-link" href="?action=logout">Logout</a>
		    </li>
		  	<?php }elseif($userLogin==true && $is_admin==0){ ?>
		  		<li class="nav-item">
		     		 <a class="nav-link" href="index.php">Task List</a>
		    	</li>
		  		 <li class="nav-item">
		      		<a class="nav-link" href="InOutTimeSet.php">Attendance</a>
		    	</li>
		    	<li class="nav-item">
		      		<a class="nav-link" href="?action=logout">Logout</a>
		    	</li>
		  	
			<?php }else{ ?>

				 <li class="nav-item">
		      		<a class="nav-link" href="login.php">Login</a>
		    	</li>

			<?php }?>




		 	
		   
		   
		    
		     
		  </ul>
</nav> 
		
	</div>

</body>
</html>

