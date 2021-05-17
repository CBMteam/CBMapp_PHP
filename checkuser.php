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
$friend_email = $_POST['friend_email'];
$result = mysqli_query($con, "select * from profile where email = '$friend_email'");
$total_record = mysqli_num_rows($result);
if ($total_record == 0) {
    echo 'noSuchEmail';
} else {
    $insertcheck = mysqli_query($con, "select * from friend where email = '$user_email' and friend_email = '$friend_email'");
    $total_record = mysqli_num_rows($insertcheck);
    if ($total_record > 0) {
        echo 'duplicateEmail';
    } else {
        $result = mysqli_query($con, "insert into friend(email, friend_email) values ('$user_email','$friend_email')");
        if ($result) {
            echo 'success';
        } else {
            echo 'failure';
        }
    }
}
mysqli_close($con);
?>