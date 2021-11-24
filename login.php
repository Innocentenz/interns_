<?php
          require_once('backend/db.php');
          session_start();
          // error_reporting(0);
          $errors = '';
            // posting data
          if (isset($_POST['login'])) {
            // error array
            $errors = array();
            // keep values in variables
            $post_email = trim($_POST['email']);
            $post_password = $_POST['password'];
            // check whether empty

            if (empty($post_email) && empty($post_password)) {
                $errors = 'Sorry come values are empty';
                exit;
            }
            // check email
            if(!filter_var($post_email, FILTER_VALIDATE_EMAIL)){
                $errors = 'email is invalid';
                exit;
            }

            $hash_password = md5($post_password);
            $query =mysqli_query($conn, "SELECT id, email, pasword from users where email = '$post_email'");
              $row = mysqli_num_rows($query);
                if($row > 0){
                  $row = mysqli_fetch_assoc($query);
                  if ($row['pasword'] !== $hash_password) {
                  
                echo '<script>
                    alert("user not found");
                    window.location.href = "login.php";
                    </script>';
            
                      exit;
                  }
                $userid = $row['id'];
              $query = mysqli_query($conn, "INSERT into login_activity(users_id)  values ('$userid')");
                   echo '<script>
                    alert("Login success");
                    window.location.href = "dashboard.php";
                    </script>';
                    $_SESSION['id'] = $userid;
                      exit;
                }
                $errors = 'user does not exist';
                
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
        <h1 class="text-bold main">Login Form <i class="fa fa-user"></i> </h1>
        
        <form class="col-6" action="" method="post" name="login" id="login" enctype="multipart/form-data" autocomplete="off">
            <?php
        if(!empty($errors)):
           ?>
          <div class="alert alert-danger"> <?php echo $errors; ?></div>
        <?php endif; ?>
        <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
        </div>
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" name="login" class="btn btn-success btn-lg mt-5">Login</button>
        <a href="register.php" class="nav nav-bar mt-5">If you an account, please Sign up</a>
        </form>
      </div>
      </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
  </body>
</html>
