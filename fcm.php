<?php
$con = mysqli_connect("ip", "user", "password", "database");
if (mysqli_connect_errno()) {
    echo "Faild to connect to MySQL:" . mysqli_connect_error();
}
header("Content-Type:text/html;charset=utf8");
mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");
if (mysqli_connect_errno()) {
    echo "Faild to connect to MySQL:" . mysqli_connect_error();
}
define('GOOGLE_API_KEY', "apikey");
function send_notification($token, $message) {
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array('to' => $token, 'notification' => $message);
    $headers = array('Authorization:key =' . GOOGLE_API_KEY, 'Content-Type: application/json');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('Curl failed: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
$user_email = $_POST['email'];
$user_location = $_POST['location'];
$result = mysqli_query($con, "SELECT token FROM db.profile where email in (select friend_email from friend where email='$user_email')");
$tokens = array();
while ($row = mysqli_fetch_array($result)) {
    $tokens[] = $row['token'];
}
$message_string = $user_email . "의 위치: " . $user_location;
$message = array("title" => "$message_string", "message" => $message_string);
$message_status = send_notification($tokens[0], $message);
print_r($message_status);
mysqli_close($con);
?>