<?php

$db_host = "140.136.150.68:33066";
$db_user = "root";
$db_password = "880323";
$db_name = "chess";

$connect = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if(!$connect)
{
	echo "Connect to DB failed!";
	exit;
}
else
	//echo "Connection Success!";

?>