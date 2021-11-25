<?php 
		 require_once('backend/db.php');
          session_start();
          $userid = $_SESSION['id'];
          $query = mysqli_query($conn, "SELECT * from users where id = '$userid'");
          $row = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html>
<head>
	<head>
    <meta charset="utf-8">
    <meta name="keywords" content="login">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="we sell information">
    <title>Dashboard</title>
    <link rel="shortcut icon" type="image/png" href="assets/img/enter.png">
    <link rel="stylesheet" href="assets/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="assets/css/all.css" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
  </head>
</head>
<body class="container">
		<p>email:  <?php echo $row['email']; ?></p>
		<p>contact: <?php echo $row['contact']; ?></p>
		<p>name: <?php echo $row['name']; ?></p>
		
		<?php
		$query = mysqli_query($conn, "SELECT * from login_activity where users_id = '$userid'");
          $row = mysqli_num_rows($query);
		?>
		<h1>You have been logged in <?php echo $row;  ?> </h1>
		<a href="logout.php" class="btn btn-outline-warning">Logout</a>
        <?php
                $errors = array();
                if (isset($_POST['submit'])) {
                    $subject = $_POST['subject'];
                    $body = $_POST['body'];

                    $query = mysqli_query($conn, "INSERT INTO messages(message_subject,message_body,message_users_id) Values('$subject','$body','$userid')");
                    if ($query) {
                        echo "<script>
                        alert('Message sent successfully');
                        window.location.href = 'dashboard.php';
                        </script>";
                    }
                    $errors = 'submit error';

                }
                $errors = 'button error';
        ?>
        <form method="post" action="" class="form-horizontal"  enctype="multipart/form-data">
                    <input type="text" name="subject" placeholder="subject"> <br>
                    <textarea type = "text" name="body"></textarea> <br>
                    <button type="submit" name="submit">Send SMS</button>
        </form>
	<script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>