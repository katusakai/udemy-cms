<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
$error_text = NULL;


if(isset($_POST['submit'])){
  $to       = 'katusakai@gmail.com';
  $subject  = mysqli_real_escape_string($connection, $_POST['subject']);
  $subject  = wordwrap($subject, 70);
  $body     = mysqli_real_escape_string($connection, $_POST['body']);
  $header   = mysqli_real_escape_string($connection, $_POST['email']); 
  $header = "From: " . $header;
  mail($to, $subject, $body, $header);
}
 ?>

    <!-- Navigation -->

    <?php  include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                <p class="bg-danger"><?php echo $error_text; ?></p>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                         <div class="form-group">
                            <textarea class="form-control" name="body" id="" cols="50" rows="10"></textarea>
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
