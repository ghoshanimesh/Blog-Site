<?php
    $user_id = $_SESSION['user_id'];
    if($user_role == "admin"){
        $post_query = "SELECT * FROM posts";
        
        $approved_comment_query = "SELECT * FROM comments WHERE comment_status='approved'";
        
        $unapproved_comment_query = "SELECT * FROM comments WHERE comment_status='unapproved'";
    }else{
        $post_query = "SELECT * FROM posts WHERE post_author = $user_id";
        
        $approved_comment_query = "SELECT * FROM comments WHERE comment_post_id in (SELECT post_id from posts WHERE post_author =$user_id) and comment_status='approved'";
        
        $unapproved_comment_query = "SELECT * FROM comments WHERE comment_post_id in (SELECT post_id from posts WHERE post_author =$user_id) and comment_status='unapproved'";
    }
$categories_query = "SELECT * FROM categories";

$post_count_query = mysqli_query($connection, $post_query);
$post_count = mysqli_num_rows($post_count_query);

$approved_comment_resultset = mysqli_query($connection, $approved_comment_query);
$approved_comment_count = mysqli_num_rows($approved_comment_resultset);

$unapproved_comment_resultset = mysqli_query($connection, $unapproved_comment_query);
$unapproved_comment_count = mysqli_num_rows($unapproved_comment_resultset);

$categories_count_resultset = mysqli_query($connection, $categories_query);
$categories_count = mysqli_num_rows($categories_count_resultset);

?>


<!-- row -->
<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $post_count; ?></div>
                        <div>Post Count</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><a href="posts.php">View Details</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $approved_comment_count; ?></div>
                        <div>Approved Comments</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><a href="comments.php">View Details</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $unapproved_comment_count; ?></div>
                        <div>Unapproved Comments</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><a href="comments.php">View Details</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $categories_count; ?></div>
                        <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="#">
                <div class="panel-footer">
                    <span class="pull-left"><a href="categories.php">View Details</a></span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /.row -->
<div class="row">
    <div class="col-md-6">
        <div id="columnchart_material" style="height: 500px;"></div>
    </div>
    <div class="col-md-6">
        <div id="piechart_3d" style="height: 500px;"></div>
    </div>
</div>

