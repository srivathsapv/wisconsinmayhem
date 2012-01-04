<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script type ="text/javascript">
			$(document).ready(function(){
				var t = (window.innerHeight-750)/2;
				$("#tabs").tabs({width: 100});
				$("#login-button").button();
				$("#tabs").css("top",t);
			});
			
			function login()
			{
				var regno = $("#regno").val();
				var password = $("#password").val();
				$.ajax({
					type: 'POST',
					data: "regno=" + regno + "&password=" + password,
					url: "login.php",
					success: function(data){
						if (data != 1){
							$("#result").html(data);
						}
						if(data == 1)
						{
							window.location = "http://localhost/jce/marks.php?regno=" + regno;
						}
					}
				});
				
			}
		</script>
	</head>
</html>

<body>
	<?php include('header.php'); ?>
	<center>
		<br><h1>Student's Login</h1>
		<p class = "desc">Students can use their register number to login and view their internal exam marks</p>
		<img src = "images/user_login.png" height = 150 width = 150>
		<div id="tabs">
			<ul>
				<li><a href="#tabs-1">Login</a></li>
			</ul>
			<div id="tabs-1">
				<form id = "login-form" method = "post">
					Register No: <input id="regno" name="regno" type="text"><br><br>
					Password:&nbsp;&nbsp;&nbsp; <input id="password" name="password" type="password">
				</form>
				<button id="login-button" onClick="login()">Login</button>
				<div id = "result"></div>
			</div>
		</div>
	</center>
	<?php include('footer.php'); ?>
</body>