<!DOCTYPE html>
<?php
    ob_start();
?>

<html lang="en">

<?php
    $page = "comments";
    include_once("includes/header.php");
    include_once("functions.php");
    
?>

<body>
    <?php
        if($connection){
            echo "Hello";
        }
    ?>        

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
                                case 'add_post':
                                    include_once("includes/posts/add_post.php");
                                    break;
                                
                                case 'edit_post':
                                    include_once("includes/posts/edit_post.php");
                                    break;
                                    
                                default:
                                    include_once("includes/comments/view_all_comments.php");
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