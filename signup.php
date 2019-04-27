<?php

$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];

if((!isset($username) || is_null($username) || empty($username))
	|| (!isset($password) || is_null($password) || empty($password))
	|| (!isset($name) || is_null($name) || empty($name))
	|| (!isset($email) || is_null($email) || empty($email)))
{
	echo "<script>alert("所有欄位不能為空")</script>";
}
else
{
	include("db_connect.php");

	$query = "INSERT INTO `user` VALUES ('$username', '$password', '$name', '$email')";

	$result = mysqli_query($connect, $query);

	mysqli_close($connect);

	echo "<script>alert("註冊成功!")</script>";
}

?>