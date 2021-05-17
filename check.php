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
$result = mysqli_query($con, "select bloodsugar from db.bloodsugar  where email='$user_email' order by idx desc LIMIT 1;");
if ($result < 70) {
    echo 'OK';
} else {
    echo 'notOK';
}
mysqli_close($con);
?>