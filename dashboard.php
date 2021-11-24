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
<body>
		<p>email:  <?php echo $row['email']; ?></p>
		<p>contact: <?php echo $row['contact']; ?></p>
		<p>name: <?php echo $row['name']; ?></p>
		
		<?php
		$query = mysqli_query($conn, "SELECT * from login_activity where users_id = '$userid'");
          $row = mysqli_num_rows($query);
		?>
		<h1>You have been logged in <?php echo $row;  ?> </h1>
		<a href="logout.php" class="btn btn-outline-warning">Logout</a>
	<script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>