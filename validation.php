<?php

session_start();


$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'twilio_sms');

$id = $_POST['idNum'];
$pass = $_POST['password'];
$first = $_POST['firstName'];
$last = $_POST['lastName'];
$phone = $_POST['phoneNum'];
$prog = $_POST['program'];

$s = "select * from user where id = '$id' && password = '$pass'";
$result = mysqli_query($con, $s);
$num = mysqli_num_rows($result);

if($num == 1){
    $_SESSION['welcomeID'] = $id;
   header('location:home.php');
}
else {
    header('location:login.php');
}

?>