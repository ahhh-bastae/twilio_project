<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'twilio_sms');

$id = $_POST['id'];
$password = $_POST['password'];

$sql = "SELECT * FROM user WHERE id = '$id' && password = '$password'";
$result = mysqli_query($con, $sql);
$num = mysqli_num_rows($result);
$row = $result->fetch_assoc();

if($num == 1){
    $_SESSION['user_id'] = $_POST['id'];
    $_SESSION['is_logged_in'] = true;
    if ($row['type'] == 1) {
        header('location:home.php');
    } else {
        header('location:userlog.php');
    }
}
else { header('location:index.php'); }

?>