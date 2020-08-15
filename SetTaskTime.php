<?php   include 'layout/header.php';
        include 'api/Task.php';
        include 'api/DbConnection.php';
        Session::checkSession();
 ?>


    <div class="panel panel-default container">
        
    <div class="panel-heading">
        
        <?php

        if(isset($_GET['task_id'])){
            $task_id = $_GET['task_id'];

        }

        $task = new Task();

        if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_timeline'])) {
             $setTaskTime = $task->setTimeline($task_id, $_POST);
        }
       
         

         ?>
    </div>
    <div class="panel-body" style="max-width:600px; margin:0 auto;">
        <h2 class="text-center">Assign Task Timeline</h2>
        <?php 
            if (isset($setTaskTime)) {
                echo $setTaskTime;
            }
        ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" name="start_time" id="start_time" class="form-control" />
            </div>

             <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" name="end_time" id="end_time" class="form-control" />
            </div>

            
            <button type="submit" class="btn btn-success"  name="add_timeline">Add</button>
            
        </form>
        
    </div>
</div>



