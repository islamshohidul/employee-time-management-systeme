<?php 
    
    include 'layout/header.php';
    include 'api/SetPassword.php'; 
    
?>
<?php

    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['set_pass'])) {

        $set_pass = new SetPassword();
        $newPasswordSet = $set_pass->setNewPassword($_POST);
          

      }  

?>


    <div class="panel panel-default container">
        
    <div class="panel-heading">
         <?php 
            if (isset($newPasswordSet)) {

                echo $newPasswordSet;
            }
        ?>
        
        
        
    </div>
    <div class="panel-body" style="max-width:600px; margin:0 auto;">
        <h2 class="text-center">Set Password</h2>
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="old_password">Old Password</label>
                <input type="password" name="old_password" id="old_password" class="form-control" />
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>

            <button type="submit" class="btn btn-success"  name="set_pass">Set Password</button>
            
        </form>
        
    </div>
</div>
