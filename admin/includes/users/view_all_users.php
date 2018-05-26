<div class="col-xs-12">
    <table class="table table-bordered table-hover">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Role</th>
            <th>Image</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tbody>
        <?php   
            $query = "SELECT * FROM users";
            $select_all_users_query = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($select_all_users_query)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_role = $row['user_role'];
                $user_image = $row['user_image'];

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$username</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";
                echo "<td><img src='images/users/$user_image' class='img-circle img-responsive' alt='User image' width=75px></td>";
                
                echo "<td><a class='btn btn-success' href='users.php?make_admin=$user_id'><span class='fa fa-users'> Make Admin</span></a></td>";   
                
                echo "<td><a class='btn btn-warning' href='users.php?make_subscriber=$user_id'><span class='fa fa-user'> Make Subscriber</span></a></td>";
            
                echo "<td><a class='btn btn-primary' href='users.php?source=edit_user&edit_user=$user_id'><span class='fa fa-pencil'> Edit</span></a></td>";
                
                echo "<td><a class='btn btn-danger' href='users.php?delete=$user_id'><span class='fa fa-trash'> Delete</span></a></td>";
                
                echo "</tr>";
            }    
            ?>
        </tbody>
    </table>
    <?php
        //Code for Making Admin
        if(isset($_GET['make_admin'])){
            $make_admin_user_id = $_GET['make_admin'];
            $query = "UPDATE users SET user_role='admin' WHERE user_id = $make_admin_user_id";
            $change_role_query = mysqli_query($connection,$query);
            confirmQuery($change_role_query);
            header('Location: users.php');
        }    
    
        //Code for Making Suscriber
        if(isset($_GET['make_subscriber'])){
            $make_suscriber_user_id = $_GET['make_subscriber'];
            $query = "UPDATE users SET user_role='subscriber' WHERE user_id = $make_suscriber_user_id";
            $change_role_query = mysqli_query($connection,$query);
            confirmQuery($change_role_query);
            header('Location: users.php');
        }     
    
        //Code for Delete
        if(isset($_GET['delete'])){
            $delete_user_id = $_GET['delete'];            
            $query = "DELETE FROM users WHERE user_id = $delete_user_id";
            $delete_user_query = mysqli_query($connection,$query);
            confirmQuery($delete_user_query);
            header('Location: users.php');
        }
    ?>
</div>