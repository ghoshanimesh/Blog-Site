<?php
    if(isset($_POST['submit'])){
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From: Study Link <enquiry@studylinkclasses.com>' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        $to = $_POST['emailid'];
        $subject = $_POST['subject'];
        
        $body = $_POST['comments'];
        $sentstatus = mail($to, $subject, $body, $headers);
//        FOR TESTING STATUS
//        if(!sentstatus){
//            echo error_get_last()['message'];
//        }else{
//            echo "Sent";
//        }
    }
?>
<html>
    <?php 
        $title = "Contact Us";
        include_once("includes/header.php"); 
        include_once("includes/db.php");
    ?>
    <body>
        <?php include_once("includes/navigation.php"); ?>
        <div class="col-md-6 col-md-offset-3">
           <form action="" method="post" role="form">
               <legend>Contact Us!</legend>
               
               <div class="form-group">
                   <label for="emailid">Email Id</label>
                   <input type="email" class="form-control" id="emailid" name="emailid" placeholder="Enter Your Email">
               </div>
               
               <div class="form-group">
                   <label for="subject">Subject</label>
                   <input type="text" class="form-control" id="subject" name="subject" placeholder="Your Subject">
               </div>
               
               <div class="form-group">
                   <label for="comments">Email Id</label>
                   <textarea class="form-control" id="comments" name="comments" placeholder="Your Comments" rows="10"></textarea>
               </div>               
               
               <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg">Submit</button>
           </form>
        </div>
        
    </body>
</html>


