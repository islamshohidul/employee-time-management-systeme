<?php 
    include 'layout/header.php';  
    include 'api/Task.php';
    include 'api/DbConnection.php';
    Session::checkSession();

?>

<?php 
    $task = new Task();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_task'])){

        $employeeTask = $task->createTask($_POST); 

    }

?>


    <div class="panel panel-default container">
        
    <div class="panel-heading">
        
        
    </div>
    <div class="panel-body" style="max-width:600px; margin:0 auto;">
        <h2 class="text-center">Assign task to Employee</h2>
         <?php 
            if(isset($employeeTask)){
                echo $employeeTask;

            }
        ?> 
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="task_name">Task name</label>
                <input type="text" name="task_name" id="task_name" class="form-control" />
            </div>

            <div class="form-group">
              <label for="sel1">Assign to</label>
              <select class="form-control" id="sel1" name="id">
                <?php 
                    $employees = new Task(); 
                    $employeesData = $employees->getEmployees();
                    if (isset($employeesData)) {
                        foreach ($employeesData as $employee) {
                ?>
                      <option value="<?php echo $employee['id']?>"> <?php echo $employee['full_name']?></option>
            <?php }}?>
                
              </select>
            </div>
            
            <button type="submit" class="btn btn-success"  name="add_task">Add</button>
            
        </form>
        
    </div>
</div>



