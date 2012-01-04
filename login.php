<?php
	$regno = $_POST['regno'];
	$password = $_POST['password'];
	
	mysql_connect("localhost","root","") or die(mysql_error());
	mysql_select_db("jce") or die(mysql_error());
	
	$query = "SELECT * FROM students WHERE regno = '" . $regno . "'";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	if($row)
	{
		if($row['password'] == md5($password))
		{
			echo 1;
		}
		else
		{
			echo "<span class = 'error'>Invalid username or password</span>";
		}
	}
	else
	{
		echo "<span class = 'error'>Invalid username or password</span>";
	}
	mysql_close();
?>
	