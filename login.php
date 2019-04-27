<!DOCTYPE html>
<html>

<head>

	<title>Login Page</title>
	<meta charset="utf-8">
	
</head>

<body>

	<div style="text-align: center">
		<h1>Login</h1>
		<form name="login" action="login.php" method="post">
			<p>帳號: <input type="text" name="account"></p>
			<p>密碼: <input type="password" name="password"></p>
			<p><input type="submit" name="submit" value="登入"></p>
		</form>
	</div>

</body>

</html>

<?php

if(isset($_POST['submit']))
{
	$account = $_POST['account'];
	$password = $_POST['password'];

	if((!isset($account) || is_null($account) || empty($account))
		|| (!isset($password) || is_null($password) || empty($password)))
	{
		echo "<script>alert(\"帳號密碼不能為空\")</script>";
	}
	else
	{
		include("db_connect.php");

		$query = "SELECT * FROM `user` WHERE username='$account' AND password='$password'";
		$query2 = "SELECT * FROM `user` WHERE email='$account' AND password='$password'";

		$result = mysqli_query($connect, $query);
		$result2 = mysqli_query($connect, $query2);

		$row = mysqli_num_rows($result);
		$row2 = mysqli_num_rows($result2);

		if($row || $row2)
		{
			mysqli_close($connect);
			echo "<script>alert(\"登入成功\")</script>";
			echo "<script>window.location.href='index.php'</script>";
		}
		else
			echo "<script>alert(\"帳號密碼錯誤\")</script>";

		mysqli_close($connect);
	}

}

?>