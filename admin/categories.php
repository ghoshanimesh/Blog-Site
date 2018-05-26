<!DOCTYPE html>
<?php
    ob_start();
?>

<html lang="en">

<?php
    $page = "categories";
    include_once("includes/header.php");
    include_once("functions.php");
    
?>

<body>
    <?php
    //    if($connection){
    //        echo "Hello";
    //    }
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
                    <!-- ADD Category FORM -->
                    <?php include_once("includes/category/add_category.php");?>
                    <!-- END OF CATEGORY FORM -->
                    <!-- EDIT Category FORM -->
                    <?php include_once("includes/category/edit_category.php");?>
                    <!-- END OF EDIT CATEGORY FORM -->                                
                    <?php include_once("includes/category/view_category.php");?>
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