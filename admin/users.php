<!DOCTYPE html>
<?php
    ob_start();
?>

<html lang="en">

<?php
    $page = "users";
    include_once("includes/header.php");
    include_once("functions.php");


?>

<body>       

    <div id="wrapper">
        <!-- Navigation -->
        <?php
            include_once("includes/navigation.php");
        ?>
        
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to CPanel
                            <small><?php echo $username; ?></small>
                        </h1>
                        <?php
                            //Conditional Routing
                            $source = "";
                            if(isset($_GET['source'])){
                                $source = $_GET['source'];
                            }
                            switch($source){
                                case 'add_user':
                                    include_once("includes/users/add_user.php");
                                    break;
                                
                                case 'edit_user':
                                    include_once("includes/users/edit_user.php");
                                    break;
                                    
                                default:
                                    include_once("includes/users/view_all_users.php");
                                    break;
                            }
                        ?>
                        
                    </div>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div><!-- /#page-wrapper -->
    </div><!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>