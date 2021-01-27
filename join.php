<?php

$con = mysqli_connect("localhost", "user", "passwd", "db");
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

$user_email  = $_POST['email'];
$user_pw     = $_POST['passwd'];
$user_birth  = $_POST['birth'];
$user_weight = $_POST['weight'];



$result = mysqli_query($con, "insert into profile (email, passwd, birth, weight) values ('$user_email','$user_pw', '$user_birth', '$user_weight')");



if ($result) {
    
    echo 'success';
    
}

else {
    
    echo 'failure';
    
}



mysqli_close($con);

?>
