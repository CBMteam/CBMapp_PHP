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
$user_email = $_POST['email'];
$user_pw = $_POST['passwd'];
$user_token = $_POST['token'];
$result = mysqli_query($con, "select * from profile where email = '$user_email' and passwd = '$user_pw' ");
mysqli_query($con, "update profile set token = '$user_token' where email = '$user_email' ");
$total_record = mysqli_num_rows($result);
if ($total_record == 0) {
    echo 'notOK';
} else {
    echo 'OK';
}
mysqli_close($con);
?>