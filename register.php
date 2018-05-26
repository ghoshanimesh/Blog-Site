<!DOCTYPE html>
<html lang="en">

<?php
    //includes the files only once, include includes many time as you want
    $title = "Register Yourself";
    include_once("includes/header.php");
    include_once("admin/functions.php");
    include_once("includes/db.php");
    
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $password = $_POST['password'];
        $emailid = $_POST['emailid'];
        //echo $username . " " . $firstname . " " .$lastname . " " .$password . " " .$emailid;
        //Cleaning all inputs
        $username = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname = mysqli_real_escape_string($connection, $lastname);
        $emailid = mysqli_real_escape_string($connection, $emailid);
        $password = mysqli_real_escape_string($connection, $password);
        
        $query = "SELECT * FROM users WHERE username = '$username'";
        $checkusername = mysqli_query($connection, $query);
        if(mysqli_num_rows($checkusername) > 0){
            echo "Username Exists";
        }else{
            $options = [
                'cost' => 10,
                'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
            ];
            
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
            $query = "INSERT into users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUES ('$username', '$hashed_password', '$firstname', '$lastname', '$emailid', '', 'subscriber')";
            
            $insert_user_query = mysqli_query($connection, $query);
            confirmQuery($insert_user_query);
            echo "User Registered Successfully";
        }
        
    }
?>

<body>  
    <!-- Page Content -->
    <div class="container">

        <div class="row">
           <div class="col-md-6 col-md-offset-3">
               <form action="" method="post" role="form">
                   <legend>Register</legend>
                   
                   <div class="form-group">
                       <label for="firstname">First Name</label>
                       <input type="text" class="form-control" id="firstname" placeholder="Enter your First Name" name="firstname">
                   </div>
                   
                   <div class="form-group">
                       <label for="lastname">Last Name</label>
                       <input type="text" class="form-control" id="lastname" placeholder="Enter your Last Name" name="lastname">
                   </div>
                   
                   <div class="form-group">
                       <label for="username">Username</label>
                       <input type="text" class="form-control" id="username" placeholder="Enter your username" name="username">
                   </div>
                   <div class="form-group">
                       <label for="emailid">Email Id</label>
                       <input type="text" class="form-control" id="emailid" placeholder="someone@example.com" name="emailid">
                   </div>  
                   <div class="form-group">
                       <label for="password">Password</label>
                       <input type="password" class="form-control" id="password" placeholder="Please provide some strong password" name="password">
                   </div>        
                    <div class="form-group">                 
                       <button type="submit" class="btn btn-primary" name="register">Submit</button>
                    </div>
               </form>
           </div>
            
        </div>
        <!-- /.row -->
        <?php
            include_once("includes/footer.php");
        ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>