<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'login_intern_2';

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die ("connection error :".  mysqli_connect_error());
}
// echo "connection successful";
