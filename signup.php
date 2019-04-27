<!DOCTYPE html>
<html>

<head>

	<title>Login Page</title>
	<meta charset="utf-8">
	
</head>

<body>

	<div style="text-align: center">
		<h1>Register</h1>
		<form name="signup" action="signup.php" method="post">
			<p>Username: <input type="text" name="username"></p>
			<p>Password: <input type="text" name="password"></p>
			<p>Your name: <input type="text" name="name"></p>
			<p>E-mail: <input type="text" name="email"></p>
			<p><input type="submit" name="submit" value="好了快註冊啦!"></p>
		</form>
	</div>

</body>

</html>

<?php

if(isset($_POST['submit']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	$name = $_POST['name'];
	$email = $_POST['email'];

	if((!isset($username) || is_null($username) || empty($username))
		|| (!isset($password) || is_null($password) || empty($password))
		|| (!isset($name) || is_null($name) || empty($name))
		|| (!isset($email) || is_null($email) || empty($email)))
	{
		echo "<script>alert(\"所有欄位不能為空\")</script>";
		exit;
	}
	else
	{
		include("db_connect.php");

		$query = "SELECT * from `user` WHERE username='$username'";
		$query2 = "SELECT * from `user` WHERE email='$email'";

		$result = mysqli_query($connect, $query);
		$result2 = mysqli_query($connect, $query2);

		$row = mysqli_num_rows($result);
		$row2 = mysqli_num_rows($result2);

		if($row)
			echo "<script>alert(\"username 已被使用!\")</script>";
		else if($row2)
			echo "<script>alert(\"E-mail 已被使用!\")</script>";
		else
		{
			$query = "INSERT INTO `user` VALUES ('$username', '$password', '$name', '$email')";

			$result = mysqli_query($connect, $query);

			mysqli_close($connect);

			echo "<script>alert(\"註冊成功!\")</script>";
			echo "<script>window.location.href='login.php'</script>";
		}

		mysqli_close($connect);
	}
}

?>