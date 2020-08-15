
<?php 

include 'api/User.php';
include 'api/Task.php';

$user = new User();


?>
<?php 
include 'layout/header.php';
Session::checkSession();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Employee time management system</title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="style/bootstrap.min.js"></script>
</head>
<body>

	<div class="container">
		
		<div class="panel panel-default mb-4">
			<?php 
			$msg =  Session::get("msg");

			if (isset($msg)) {

				echo $msg;
			}

			Session::set("msg",NULL);

			?>
		  <div class="panel-heading text-center m-3"><h3>Task list</h3></div>
		  <?php if(Session::get('is_admin')==1){?>
		  <a class="btn btn-primary mb-3 float-right" href="CreateTask.php">Add new Task</a>
		<?php }?>
		  <div class="panel-body">
		  	<table class="table table-striped">
			    <thead>
			      <tr>
			        <th>#</th>
			        <th>Task Name</th>
			        <?php if(Session::get('is_admin')==0){?>
			        <th>Set Timeline</th>
			        <?php }?>
			      </tr>
			    </thead>
			    <tbody>
			    	<?php $is_admin = Session::get('is_admin');
			    			$login = Session::get('login');	
			    			$tasks = new Task();
			    			$allUsersTask = $tasks->getAllTasks();
			    			$loggedinUserTask = $tasks->getSingleUserTask();
			    	 if(  $is_admin==1){ $i=0; foreach ($allUsersTask as $task) {
			    	 	$i++;
			    	 	# code...
			    	  ?>
			      <tr>
			        <td><?php echo $i?></td>
			        <td><?php echo $task['task_name']?></td> 
			      </tr>
			  <?php }} else{ foreach ($loggedinUserTask as $task) {?>
			 
			  	<tr>
			        <td>1</td>
			        <td><?php echo $task['task_name']?></td>
			        <?php?>
			         <td><a href="SetTaskTime.php?task_id=<?php echo $task['id']?>">Set time</a></td>
			        <?php?>
			       
			      </tr>

			  <?php }}?>
			    </tbody>
  			</table>
		  </div>
		</div>
		
	</div>

</body>
</html>