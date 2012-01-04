<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script type ="text/javascript">
			$(document).ready(function(){
				$("#stafftabs").tabs();
			});
		</script>
	</head>
	
	<body>
		<?php include('header.php');?>
		
		<?php
			$staffid = $_GET['id'];
			
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("jce") or die(mysql_error());
			
			$query = "SELECT * FROM staff WHERE id = " . $staffid;
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			
			$name = $row['name'];
			$photo = $row['photo'];
			$quali = $row['qualification'];
			$exp = $row['experience'];
			$research = $row['research'];
			file_put_contents("images/ran",$row['photo']);
			mysql_close();
		?>
		<center>
			<br><h1>Staff Profile</h1>
			<p class = "desc">Details of various faculty of the college</p>
			<div id="stafftabs">
				<ul>
					<li><a href="#tabs-1">Staff Profile</a></li>
				</ul>
				<div id="tabs-1">
					<h1><?php echo $name;?></h1>
					<div class="divider"></div>
					<br><img src="images/ran" height=140 width=100>
					<h2>Qualification:</h2><h3><?php echo $quali;?></h3>
					<h2>Experience:</h2><h3><?php echo $exp;?></h3>
					<h2>Research:</h2><h3><?php echo $research;?></h3>
				</div>
			</div>
		</center>
		<?php include('footer.php');?>
	</body>
</html>