<?php
    //For retrieving values
    if(isset($_GET['edit_user'])){
        $edit_user_id = $_GET['edit_user'];
        $query = "SELECT * FROM users WHERE user_id = $edit_user_id";
        $edit_user_query = mysqli_query($connection, $query);
        if($row = mysqli_fetch_assoc($edit_user_query)){
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_password = $row['user_password'];
            $user_email = $row['user_email'];
            $user_role = $row['user_role'];
            $user_image = $row['user_image'];
        }
    }

    //For making changes after edit is clicked
    if(isset($_POST['edit_user'])){
        if(isset($_GET['edit_user'])){
            $user_id = $_GET['edit_user'];
            
            $user_firstname = $_POST['user_firstname'];
            $user_lastname = $_POST['user_lastname'];
            $user_email = $_POST['user_email'];
            $user_role = $_POST['user_role'];
            $username = $_POST['username'];

            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];
                   
            if(empty($post_image)){
                $query = "SELECT * FROM users WHERE user_id = $user_id";
                $select_image_query = mysqli_query($connection, $query);
                confirmQuery($select_image_query);
                if($row = mysqli_fetch_assoc($select_image_query)){
                    $user_password = $row['user_password'];
                    $user_image = $row['user_image'];
                }
                else{

                    //code to update password
                    move_uploaded_file($user_image_temp, "images/users/$user_image");
                }
            }                
            $query = "UPDATE users SET ";
            $query.= "username = '$username', ";
            $query.= "user_password = '$user_password', ";
            $query.= "user_firstname = '$user_firstname', ";
            $query.= "user_lastname = '$user_lastname', ";
            $query.= "user_email = '$user_email', ";
            $query.= "user_image = '$user_image', ";
            $query.= "user_role = '$user_role' ";
            $query.= "WHERE user_id = $user_id";

            $update_user_query = mysqli_query($connection, $query);
            confirmQuery($update_user_query);

            header("Location: users.php");  
        } 
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" id="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>
    
    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" id="user_lastname" value="<?php echo $user_lastname; ?>">
    </div> 

    <div class="form-group">
        <label for="user_email">Email ID</label>
        <input type="email" class="form-control" name="user_email" id="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
        <label for="user_role">Roles</label>
        <select name="user_role" id="user_role" class="form-control">
            <option value="admin" <?php if($user_role == "admin"){echo "selected";}?>>Admin</option>
            <option value="subscriber" <?php if($user_role == "subscriber"){echo "selected";}?>>Subscriber</option>
        </select>
        <!-- <input type="text" class="form-control" name="status" id="post_status"> -->
    </div>  
    
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
    </div>   
       
    <div class="form-group">
       <label>Current Image</label>
        <img src="images/users/<?php echo $user_image;?>" width="100px" alt="" class="img-responsive">
    </div>       
        
    <div class="form-group">
        <label for="user_image">User Image</label>
        <input type="file" name="user_image" id="user_image" class="form-control" value="<?php echo $user_image; ?>">
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="edit_user" value="Edit User">
    </div>                                                
</form>
