<?php
    if(isset($_POST['create_user'])){

        
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_password_confirm = $_POST['user_password_confirm'];
        
        $user_image = $_FILES['user_image']['name'];
        $user_image_temp = $_FILES['user_image']['tmp_name'];
        
        if($user_password === $user_password_confirm){
            //=== checks for type and value but == checks only for values
            $query = "SELECT * FROM users";
            $fetch_all_username_query = mysqli_query($connection, $query);
            confirmQuery($fetch_all_username_query);
            $flag = 0;
            while($row = mysqli_fetch_assoc($fetch_all_username_query)){
                if($username == $row['username']){
                    echo "<p class='text-danger'>USERNAME EXISTS</p>";
                    break;
                }
                else{
                    $flag = 1;
                }
            }//end of while
            if($flag == 1){
                move_uploaded_file($user_image_temp, "images/users/$user_image");
                
                $hash_password = password_hash($user_password, PASSWORD_BCRYPT);

                $query = "INSERT into users(username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUES ('$username', '$hash_password', '$user_firstname', '$user_lastname', '$user_email', '$user_image', '$user_role')";

                $create_user_query = mysqli_query($connection, $query);
                confirmQuery($create_user_query); 
                header("Location: users.php");
            }
        }
        else{
            echo "<p class='text-danger'>Password and confirm password doesnt match</p>";
        }
    }
?>


<!-- Enctype other data  -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" id="user_firstname">
    </div>
    
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname">
    </div> 

    <div class="form-group">
        <label for="user_email">Email ID</label>
        <input type="email" class="form-control" name="user_email" id="user_email">
    </div>

    <div class="form-group">
        <label for="user_role">Roles</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
        <!-- <input type="text" class="form-control" name="status" id="post_status"> -->
    </div>  
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>   

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password" id="user_password">
    </div>
    
    <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" name="user_password_confirm" id="confirm_password">
    </div>
        
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image" id="user_image" class="form-control">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Create User">
    </div>                                                
</form>
