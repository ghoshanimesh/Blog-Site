<?php

if(isset($_GET['onlineusers'])){
    session_start();
    include_once("../includes/db.php");
    checkUserSession();
}

function checkUserSession(){
        global $connection;
        $session = session_id();
        $user_id = $_SESSION['user_id'];
        $time = time();//current time
        $time_out_in_seconds = 500;//timeout duration change in index.php
        $time_out = $time - $time_out_in_seconds;

        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $user_exists = mysqli_query($connection, $query);

        if(mysqli_num_rows($user_exists) == 0){
            $query = "INSERT INTO users_online(session, time, user_id) VALUES ('$session', '$time', $user_id)";
            $insert_query = mysqli_query($connection, $query);
        }
//        else{
//            //Making provision to auto logout if no activity is conducted
//            $query = "UPDATE users_online SET time = '$time' WHERE session = '$session'";
//            $update_query = mysqli_query($connection, $query);
//        }

        $query = "SELECT * FROM users_online WHERE time > $time_out";
        $online_user_query = mysqli_query($connection, $query);
        $online_user_count = mysqli_num_rows($online_user_query);
        echo $online_user_count;    
}


function checkUser(){
    if(!isset($_SESSION['username'])){
        die ("<p>You have not logged in, please login from <a href='../index.php'>here</a></p>");
    }else{
        $username = $_SESSION['username'];   
        return $username;
    }
}

function confirmQuery($result)
{
    global $connection;
    if(!$result){
        die("QUERY FAILED : ".mysqli_error($connection));
    }
}

function editCategory()
{
    global $connection; //indicates that the values are coming from external values
    if(isset($_POST['edit_submit'])){
        $input_cat_title = $_POST['cat_title'];
        $input_cat_id = $_GET['edit'];
        if($input_cat_title == "" || empty($input_cat_title)){
            echo "Please insert category Title and then try";   
        }
        else{
            $query = "UPDATE categories SET cat_title = '$input_cat_title' WHERE cat_id = '$input_cat_id'";
            $edit_cat_query = mysqli_query($connection,$query);

            if(!$edit_cat_query){
                die("QUERY FAILED: ".mysqli_error($connection));
            }
            header("Location: categories.php");
        }
    }   
}

function addCategory()
{
    global $connection;
    if(isset($_POST['submit'])){
        $input_cat_title = $_POST['cat_title'];
        if($input_cat_title == "" || empty($input_cat_title)){
            echo "<p class = 'text-danger'>Please insert category Title and then try</p>";
        }
        else{
            //For Duplicate values
            $query = "SELECT * FROM categories";
            $select_all_categories_query = mysqli_query($connection, $query);
            $flag = 0;                     
            while($row = mysqli_fetch_assoc($select_all_categories_query)){
                if(strcasecmp($input_cat_title,$row['cat_title']) == 0){
                  $flag = 1;
                    break;
                }
            }

            if($flag == 1){
                echo "<p class = 'text-danger'>Already available category. Please try something else</p>";
            }else{
                //For new values 
                $query = "INSERT INTO categories(cat_title) ";
                $query .= "VALUE('$input_cat_title')";
                $add_cat_query = mysqli_query($connection,$query);

                if(!$add_cat_query){
                    die("QUERY FAILED: ".mysqli_error($connection));
                }
                header("Location: categories.php");                                        
            }
        }
    }    
}

function fetchCategoryForEdit()
{
    global $connection;
    //Used to fetch the category title according to the get request
    if(isset($_GET['edit'])){
        $edit_cat_id = $_GET['edit'];
        $query = "SELECT * FROM categories WHERE cat_id = $edit_cat_id";
        $edit_category_title_query = mysqli_query($connection, $query);
        if($row = mysqli_fetch_assoc($edit_category_title_query)){
            return $row['cat_title'];
        }
    }    
}

?>