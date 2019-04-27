<?php

$account = $_POST['account'];
$password = $_POST['password'];

if((!isset($username) || is_null($username) || empty($username))
	|| (!isset($password) || is_null($password) || empty($password)))
{
	echo "<script>alert(\"帳號密碼不能為空\")</script>";
}
else
{
	include("db_connect.php");

	$query = "SELECT * FROM `user` WHERE username='$account' AND password='$password'";
	$query2 = "SELECT * FROM `user` WHERE username='$account' AND password='$password'";

	$result = mysqli_query($connect, $query);
	$result2 = mysqli_query($connect, $query2);

	$row = mysqli_num_rows($result);
	$row2 = mysqli_num_rows($result2);

	if($row || $row2)
		echo "<script>alert(\"登入成功\")</script>";
	else
		echo "<script>alert(\"帳號密碼錯誤\")</script>";

	mysqli_close($connect);
}

?>