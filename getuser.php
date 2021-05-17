<?php
$con = mysqli_connect("ip", "user", "password", "database");
if (mysqli_connect_errno()) {
    echo "Faild to connect to MySQL:" . mysqli_connect_error();
}
header("Content-Type:text/html;charset=utf8");
mysqli_query($con, "set session character_set_connection=utf8;");
mysqli_query($con, "set session character_set_results=utf8;");
mysqli_query($con, "set session character_set_client=utf8;");
$sql = "select * from user";
$result = mysqli_query($con, $sql);
$total_record = mysqli_num_rows($result);
echo "{\"status\":\"OK\",\"num_results\":\"$total_record\",\"results\":[";
for ($i=0; $i < $total_record; $i++) {
    mysqli_data_seek($result, $i);
    $row = mysqli_fetch_array($result);
    echo "{\"id\":$row[id],\"passwd\":\"$row[passwd]\",\"type\":\"$row[type]\"}";
    if ($i < $total_record - 1) {
        echo ",";
    }
}
echo "]}";
?>