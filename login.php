
<?php 
    
    include 'layout/header.php';
    include 'api/User.php';
    Session::checkLogin();
 ?>


 <?php 

    $user = new User();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){

        $userlogin = $user->login($_POST); 

    }
 ?>

<div class="panel panel-default container">
        
    <div class="panel-body" style="max-width:600px; margin:0 auto;">
        <h2 class="text-center">User Login</h2>
         <?php 
            if(isset($userlogin)){
                echo $userlogin;

            }
        ?> 
        
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" />
            </div>

            <button type="submit" class="btn btn-success"  name="login">Login </button>
            
        </form>
        
    </div>
</div>
