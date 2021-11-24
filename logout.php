<?php

 require_once('backend/db.php');
session_start();
unset($conn);

header('Location: login.php');
exit();