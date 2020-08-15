<?php include 'layout/header.php';
include 'api/ClockInClockOut.php';

Session::checkSession();
 ?>


    <div class="panel panel-default container">
        
    <div class="panel-heading">
        <?php 
            if ( $_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['add_time'])) {
                $time = new ClockInClockOut();
                $set_time = $time->setEntryAndExitTime($_POST);
            }

        ?>
        
    </div>
    <div class="panel-body" style="max-width:600px; margin:0 auto;">
        <h2 class="text-center">Assign Entry/Exit Time</h2>
        <?php 
            if (isset($set_time)) {

                echo $set_time;
            }
        ?>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="time">Time</label>
                <input type="time" name="time" id="time" class="form-control" />
            </div>

            <div class="form-group">
              <label for="sel1">Event type</label>
              <select class="form-control" id="sel1" name="type">
                <option value="1">Enter</option>
                <option value="0">Exit</option>
              </select>
            </div>
            
            <button type="submit" class="btn btn-success"  name="add_time">Add</button>
            
        </form>
        
    </div>
</div>



