<?php

		require_once('backend/db.php');
          session_start();
          $userid = $_SESSION['id'];
          $query = mysqli_query($conn, "SELECT * from messages where message_sent = 'N'");
          $row = mysqli_fetch_assoc($query);
          $message = $row['message_body'];



          $sendsms = SendSMS('info','bulk', '0755876951', $message);
          if ($sendsms) {
        $query = mysqli_query($conn, "UPDATE messages set  message_sent = 'Y'");
        	if ($query) {
        		echo json_encode($sendsms);
        	}

          }




function SendSMS($message_type,$message_category,$number,$message) { 

$username = '0755876951';

$password = '0755876951';

$sender = 'inno'; //(not more than 20 characters i.e letters and digits)

$url = "sms.thepandoranetworks.com/API/send_sms/?";

$parameters="number=[number]&message=[message]&username=[username]&password=[password]&sender=[sender]&message_type=[message_type]&message_category=[message_category]";

$parameters = str_replace("[message]", urlencode($message), $parameters);

$parameters = str_replace("[sender]", urlencode($sender),$parameters);

$parameters = str_replace("[number]", urlencode($number),$parameters);

$parameters = str_replace("[username]", urlencode($username),$parameters);

$parameters = str_replace("[password]", urlencode($password),$parameters);

$parameters = str_replace("[message_type]", urlencode($message_type),$parameters);

$parameters = str_replace("[message_category]", urlencode($message_category),$parameters);

$live_url="https://".$url.$parameters;

$parse_url=file($live_url);

 $response = $parse_url[0];

return json_decode($response, true);

}

// function calling


// echo json_encode($sendsms);

