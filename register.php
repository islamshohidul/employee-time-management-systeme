

<?php 
    
    include 'layout/header.php';
    include 'api/User.php';
    Session::checkSession();
 ?>


 <?php 

    $user = new User();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){

        $userRegister = $user->register($_POST); 

    }
 ?>


    <div class="panel panel-default container">
        
    <div class="panel-heading">
        
        
    </div>
    <div class="panel-body" style="max-width:600px; margin:0 auto;">
        <h2 class="text-center">Employee Registration</h2>
        <?php 
            if(isset($userRegister)){
                echo $userRegister;

            }
        ?>        
        <form action="" method="POST">
            <div class="form-group">
                <label for="full_name">Full name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" />
            </div>
            <div class="form-group">
                <label for="user_name">User Name</label>
                <input type="text" name="user_name" id="user_name" class="form-control" />
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" />
            </div>

            <button type="submit" class="btn btn-success"  name="register">Register </button>
            
        </form>
        
    </div>
</div>






