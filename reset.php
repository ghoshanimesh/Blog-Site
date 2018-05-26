<?php
    include_once("includes/db.php");
    include_once("admin/functions.php");
?>

<?php
    if(!isset($_GET['token']) || !isset($_GET['email'])){
        header("Location: index.php");
    }else{
        $token = $_GET['token'];
        $email = $_GET['email'];
        $query = "SELECT * FROM users WHERE token = '$token'";
        $updatePasswordUser = mysqli_query($connection, $query);
        if(mysqli_num_rows($updatePasswordUser) == 0){
            header("Location: index.php");
        }
    }
    if(isset($_POST['submit'])){
        if(isset($_POST['password']) && isset($_POST['password2'])){
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            if($password === $password2){
                $options = [
                    'cost' => 10,
                    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
                ];

                $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
                
                $query = "UPDATE users SET token='', user_password='$hashed_password' WHERE token='$token' AND user_email='$email'";
                $updatePassword = mysqli_query($connection, $query);
                confirmQuery($updatePassword);
                echo "Password changed succesfully";
                echo "Login and Verify";
            }else{
                echo "Both Password doesnt match";
            }
        }
    }
?>

<html>
    <?php 
        $title = "Reset Password";
        include_once("includes/header.php"); 
    ?>
    <body>
        <?php include_once("includes/navigation.php"); ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="text-center">
                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password</h2>
                                <p>You can reset your password here!</p>
                                <div class="panel-body">
                                    <form action="" role="form" id="forgot-password" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" id="password" name="password" placeholder="Please Enter New Password" class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="password" id="password2" name="password2" placeholder="Please Repeat the Password" class="form-control">
                                            </div>
                                        </div>
                                                                                
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Submit">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>


