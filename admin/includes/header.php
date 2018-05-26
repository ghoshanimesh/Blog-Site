<?php
    include_once("../includes/db.php");
    session_start();
    include_once("functions.php");
    checkUserSession();
    $username = checkUser(); 
    $user_role = $_SESSION['user_role'];
?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- Include Froala Editor CSS -->
    <link rel="stylesheet" href="js/plugins/froala/css/froala_editor.pkgd.min.css">
    <link rel="stylesheet" href="js/plugins/froala/css/froala_style.min.css">
    
    <!-- Include Bootstrap Validator -->
    <link rel="stylesheet" href="css/bootstrapValidator.min.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php
        if($page == "dashboard"){
            $user_id = $_SESSION['user_id'];
            if($user_role == "admin"){
                $post_query = "SELECT * FROM posts";

                $active_post_query = "SELECT * FROM posts WHERE post_status='published'";

                $pending_post_query = "SELECT * FROM posts WHERE post_status='draft'";

                $approved_comment_query = "SELECT * FROM comments WHERE comment_status='approved'";

                $unapproved_comment_query = "SELECT * FROM comments WHERE comment_status='unapproved'";
            }else{
                $post_query = "SELECT * FROM posts WHERE post_author = $user_id";

                $active_post_query = "SELECT * FROM posts WHERE post_status='published' AND post_author = $user_id";

                $pending_post_query = "SELECT * FROM posts WHERE post_status='draft' AND post_author = $user_id";

                $approved_comment_query = "SELECT * FROM comments WHERE comment_post_id in (SELECT post_id from posts WHERE post_author =$user_id) and comment_status='approved'";

                $unapproved_comment_query = "SELECT * FROM comments WHERE comment_post_id in (SELECT post_id from posts WHERE post_author =$user_id) and comment_status='unapproved'";
            }
            $categories_query = "SELECT * FROM categories";

            $users_query = "SELECT * FROM users";

            $post_count_query = mysqli_query($connection, $post_query);
            $post_count = mysqli_num_rows($post_count_query);

            $active_post_count_query = mysqli_query($connection, $active_post_query);
            $active_post_count = mysqli_num_rows($active_post_count_query);

            $pending_post_count_query = mysqli_query($connection, $pending_post_query);
            $pending_post_count = mysqli_num_rows($pending_post_count_query);            

            $approved_comment_resultset = mysqli_query($connection, $approved_comment_query);
            $approved_comment_count = mysqli_num_rows($approved_comment_resultset);

            $unapproved_comment_resultset = mysqli_query($connection, $unapproved_comment_query);
            $unapproved_comment_count = mysqli_num_rows($unapproved_comment_resultset);

            $categories_count_resultset = mysqli_query($connection, $categories_query);
            $categories_count = mysqli_num_rows($categories_count_resultset);

            $users_count_resultset = mysqli_query($connection, $users_query);
            $users_count = mysqli_num_rows($users_count_resultset);

    ?>

    <!-- COLUMN CHART -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Data', 'Count'],
            <?php

                $element_text = ['Active Posts', 'Posts', 'Categories', 'Users', 'Comments', 'Pending'];
                $element_count = [$active_post_count, $pending_post_count, $categories_count, $users_count, $approved_comment_count, $unapproved_comment_count];

                for($i=0; $i<6; $i++){
                    echo "['$element_text[$i]', $element_count[$i]],";
                }
            ?>
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    <!-- END OF COLUMN CHART -->

    <!-- PIE CHART -->
    <?php
        $query = "SELECT count(*) AS count_cat, cat_title FROM posts, categories WHERE posts.post_category_id = categories.cat_id AND posts.post_status='published' GROUP BY post_category_id";
        $count_post_cat_resultset = mysqli_query($connection, $query);        
    ?>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Category', 'No. of Posts'],
            <?php
                while($row = mysqli_fetch_assoc($count_post_cat_resultset)){
                    $cat_title = $row['cat_title'];
                    $count_posts = $row['count_cat'];

                    echo "['$cat_title', $count_posts], ";
                }
            ?>
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <!-- END OF PIE CHART -->
    
    

    <?php 
        }else if($page == "posts"){?>
        
           <!-- For Froala TextEditor-->
            <!-- jQuery -->
            <script src="js/jquery.js"></script>
            <script src="js/plugins/froala/js/froala_editor.pkgd.min.js"></script>
    
            <script> $(function() {$('textarea').froalaEditor() }); </script>       
    <?php
        }//end of else if    
    ?>
    
</head>