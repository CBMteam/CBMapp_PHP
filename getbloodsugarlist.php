
<?php
$con = mysqli_connect("ip", "user", "password", "database");
if (mysqli_connect_errno()) {
    echo "Faild to connect to MySQL:" . mysqli_connect_error();
}
mysqli_set_charset($con, "utf8");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['user_email'];
    $sql = "select * from bloodsugar where email='$email' order by idx desc limit 50";
    $result = mysqli_query($con, $sql);
    $data = array();
    if ($result) {
        while ($row = mysqli_fetch_array($result)) {
            array_unshift($data, array('bloodsugar' => $row[0], 'fDate' => $row[2]));
        }
        header('Content-Type: application/json; charset=utf8');
        $json = json_encode(array("bloodsugar_list" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json;
    } else {
        echo "SQL문 처리중 에러 발생 : ";
        echo mysqli_error($link);
    }
}
mysqli_close($con);
?>