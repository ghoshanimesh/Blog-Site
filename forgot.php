<?php
    include_once("includes/db.php");
    include_once("admin/functions.php");
    if(!isset($_GET['forgot'])){
        header("Location: index.php");
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $length = 50;
            $token = bin2hex(openssl_random_pseudo_bytes($length));
            
            //check whether email id exists or not
            $query = "SELECT * FROM users WHERE user_email = '$email'";
            $user = mysqli_query($connection, $query);
            if(mysqli_num_rows($user) == 1){
                //Email exists, update the token
                $query = "UPDATE users SET token = '$token' WHERE user_email = '$email'";
                $updateToken = mysqli_query($connection, $query);
                confirmQuery($updateToken);
                
                $headers = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'From: Study Link <enquiry@studylinkclasses.com>' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                $to = $email;
                $subject = "Blog Password Change";

                $body = "Please Click the Below link to reset your password:<br/><a href='http://localhost/blog/reset.php?email=$email&token=$token'>http://localhost/blog/reset.php?email=$email&token=$token</a>";
                    
                    
                $sentstatus = mail($to, $subject, $body, $headers);
//                //FOR TESTING STATUS
//                if(!$sentstatus){
//                    echo error_get_last()['message'];
//                }else{
//                    echo "Sent";
//                }                
                
                
            }else{
                echo "Some issue with email id or no such user found";
            }
        }
    }
?>

<html>
    <?php 
        $title = "Forgot Password";
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
                                <h2 class="text-center">Forgot Password</h2>
                                <p>You can reset your password here!</p>
                                <div class="panel-body">
                                    <form action="" role="form" id="forgot-password" method="post">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                <input type="email" id="email" name="email" placeholder="Please Enter your email" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-lg btn-primary btn-block" name="reset-submit" value="Submit">
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


