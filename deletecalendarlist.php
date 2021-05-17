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
$user_email = $_POST['user_email'];
$user_date = $_POST['user_date'];
$result = mysqli_query($con, "delete from insulin where email='$user_email' and date(fDate)='$user_date';");
$result = mysqli_query($con, "delete from carb where email='$user_email' and date(fDate)='$user_date';");
if ($result) {
    echo 'success';
} else {
    echo 'failure';
}
mysqli_close($con);
?>