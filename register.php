<?php
          require_once('backend/db.php');
          session_start();
          // error_reporting(0);
          $errors = '';
            // posting data
          if (isset($_POST['signup'])) {
            // error array
            $errors = array();
            // keep values in variables
            $post_email = trim($_POST['email']);
            $post_name = trim($_POST['name']);
            $post_contact = trim($_POST['contact']);
            $post_password = $_POST['password'];
            // check whether empty

            if (empty($post_email) && empty($post_name) && empty($post_contact) && empty($post_password)) {
                $errors = 'Sorry come values are empty';
                exit;
            }
            // check contact
            if(strlen($post_contact) < 0 ){
                $errors = 'invalid contact';
                exit;
            }
            // check email
            if(!filter_var($post_email, FILTER_VALIDATE_EMAIL)){
                $errors = 'email is invalid';
                exit;
            }
            $query_select = mysqli_query($conn, "SELECT email from users where email = '$post_email'");
            $row_count = mysqli_num_rows($query_select);

            if ($row_count > 0) {
              echo '<script>
                  alert("Accoutnt already exists");
                  window.location.href = "register.php";
                    </script>';
                    exit;
              // $errors = 'account already exists';
              // exit();
            }

            $hash_password = md5($post_password);
            $query = "INSERT into users (email,name,contact,pasword)
            values('$post_email', '$post_name', '$post_contact', '$hash_password')";

            if(mysqli_query($conn, $query)){
                  echo '<script>
                  alert("data has been submited");
                    </script>';
                    exit;
            }
            $errors = 'error submitting';
            exit;
          }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="keywords" content="login">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="we sell information">
    <title>login system</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/enter.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/all.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  </head>
  <body>
    <div class="container">

      <div class="row">
        <h1 class="text-bold main">Sign Form <i class="fa fa-user"></i> </h1>
          <?php
        if(!empty($errors)):
           ?>
          <div class="alert alert-danger"> <?php echo $errors; ?></div>
        <?php endif; ?>
        <form class="col-6" action="" method="post" name="login" id="login" enctype="multipart/form-data" autocomplete="off">
        <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" required>
        </div>
        <div class="mb-3">
        <label for="contact" class="form-label">Contact</label>
        <input type="tel" class="form-control" id="contact" name="contact" aria-describedby="contactHelp" required>
        </div>
        <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Agree to terms and conditions</label>
        </div>
        <button type="submit" name="signup" class="btn btn-success btn-lg">Register</button>
        <a href="login.php">If you an account, please Login</a>
        </form>
      </div>
      </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
