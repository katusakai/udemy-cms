<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
$error_text = NULL;
if(isset($_POST['submit'])){
  $username = mysqli_real_escape_string($connection, $_POST['username']);
  $email = mysqli_real_escape_string($connection, $_POST['email']);
  $password = mysqli_real_escape_string($connection, $_POST['password']);
  if(empty($username)){
    $error_text = "You need to type Username";
  } else if(empty($email)){
    $error_text = "You need to type Email";
  } else if(empty($password)){
    $error_text = "You need to type Password";
  } else{

    $randsaltquery = "SELECT user_randSalt FROM users";
    $select_randsalt_query = mysqli_query($connection, $randsaltquery);
    if(!$select_randsalt_query){
      die(mysqli_error($connection));
    }
    $row = mysqli_fetch_array($select_randsalt_query);
    $salt = $row['user_randSalt'];

    $password = crypt($password, $salt);



    $query = "INSERT INTO users (user_name, user_password, user_email, user_role)
              Values ('{$username}', '{$password}', '{$email}', 'Subscriber')";
    $register_user_query = mysqli_query($connection, $query);
    if(!$register_user_query){
      die("Error registering a user" . mysqli_error($connection));
    } else {
      echo "<p class='bg-success'>User was created successfully. You can now <a href='index.php#login'>Log In</a></p><br>";
    }
  }
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
                <h1>Register</h1>
                <p class="bg-danger"><?php echo $error_text; ?></p>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>

                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>

                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
