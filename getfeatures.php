<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('dbcon.php');
$android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");
if ((($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit'])) || $android) {
    $email = $_POST['email'];
    $stmt = $con->prepare("$result = mysqli_query($con, "SELECT id, cycle, bloodsugar, carb, insulin FROM (SELECT * FROM features WHERE email = '$email')a order by idx desc limit 311");");
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            //배열에 쿼리 결과 푸시
            array_push($data, array('board_id' => $board_id, 'title' => $title, 'content' => $content, 'writer' => $nickname, 'timestamp' => $timestamp, 'image' => $image, 'profile' => $photo1, 'verified' => $verified, 'location' => $location));
        }
        header('Content-Type: application/json; charset=utf8');
        //json으로 변환
        $json = json_encode(array("community_info" => $data), JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE);
        echo $json; //json 결과 출력
        
    }
}
?>