<html>
	<head>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#marktabs").tabs();
				$("#marktabs").css("top",(window.innerHeight-770)/2);
			});
		</script>
	</head>
	
	<body>
		<?php include('header.php'); ?>
		
		<?php
			$regno = $_GET['regno'];
			
			$grade = array("S" => 10,"A" => 9,"B" => 8,"C" => 7,"D" => 6,"E" => 5);
			
			mysql_connect("localhost","root","") or die(mysql_error());
			mysql_select_db("jce") or die(mysql_error());
			
			$query = "SELECT * FROM students WHERE regno = " . $regno;
			$result = mysql_query($query);
			$row = mysql_fetch_array($result);
			$sname = $row['name'];
			$year = $row['year'];
			$dept = $row['dept'];
			
			$query1 = "SELECT s.subname,m.grade from subjects s,marks m where s.subcode=m.subcode and m.assessment = 1 and m.regno = " . $regno;
			$query2 = "SELECT s.subname,m.grade from subjects s,marks m where s.subcode=m.subcode and m.assessment = 2 and m.regno = " . $regno;
			$query3 = "SELECT s.subname,m.grade from subjects s,marks m where s.subcode=m.subcode and m.assessment = 3 and m.regno = " . $regno;
			
			//Assessment 1 results
			$result = mysql_query($query1);
			
			$ass1 = "<table>";
			$ass1 .= "<tr><th>Subject</th><th>Grade</th></tr>";
			$i=0;
			$gpa1=0;
			$fail=false;
			while($row=mysql_fetch_array($result))
			{
				if($i % 2 == 0){
					$class = "even";
				}
				else{
					$class = "odd";
				}
				$i++;
				$ass1 .= "<tr class=$class><td>".$row['subname']."</td><td>".$row['grade']."</td></tr>";
				$gpa1 += $grade[$row['grade']];
				if($row['grade'] == 'U')
				{
					$fail=true;
				}
			}
			if(!$fail)
				$gpa1 = round($gpa1/$i,2);
			else
				$gpa1 = "NA";
			$ass1 .= "</table>";
			
			//Assessment 2 results
			$result = mysql_query($query2);
			
			$ass2 = "<table>";
			$ass2 .= "<tr><th>Subject</th><th>Grade</th></tr>";
			$i=0;
			$gpa2=0;
			$fail=false;
			while($row=mysql_fetch_array($result))
			{
				if($i % 2 == 0){
					$class = "even";
				}
				else{
					$class = "odd";
				}
				$i++;
				$ass2 .= "<tr class = $class><td>".$row['subname']."</td><td>".$row['grade']."</td></tr>";
				$gpa2 += $grade[$row['grade']];
				if($row['grade'] == 'U')
				{
					$fail=true;
				}
			}
			if(!$fail)
				$gpa2 = round($gpa2/$i,2);
			else
				$gpa2 = "NA";
			$ass2 .= "</table>";
			
			//Assessment 3 results
			$result = mysql_query($query3);
			
			$ass3 = "<table>";
			$ass3 .= "<tr><th>Subject</th><th>Grade</th></tr>";
			$i=0;
			$gpa3=0;
			$fail=false;
			while($row=mysql_fetch_array($result))
			{
				if($i % 2 == 0){
					$class = "even";
				}
				else{
					$class = "odd";
				}
				$i++;
				$ass3 .= "<tr class = $class><td>".$row['subname']."</td><td>".$row['grade']."</td></tr>";
				$gpa3 += $grade[$row['grade']];
				if($row['grade'] == 'U')
				{
					$fail=true;
				}
			}
			if(!$fail)
				$gpa3 = round($gpa3/$i,2);
			else
				$gpa3 = "NA";
			$ass3 .= "</table>";
			mysql_close();
		?>
		<center>
			<br><h1>Mark details</h1>
			<p class = "desc">Subject-wise grades in all the internal exams</p>
			<br><img src="images/percentage.jpg" height=150 width=150>
			<div id="marktabs">
				<ul>
					<li><a href="#tabs-1">Details</a></li>
					<li><a href="#tabs-2">Assessment 1</a></li>
					<li><a href="#tabs-3">Assessment 2</a></li>
					<li><a href="#tabs-4">Assessment 3</a></li>
				</ul>
				<div id="tabs-1">
					<table>
						<tr class ="odd"><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Register No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td><?php echo $regno; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
						<tr class ="even"><th>Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td><?php echo $sname; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
						<tr class ="odd"><th>Year&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td><?php echo $year; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
						<tr class ="even"><th>Department&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th><td><?php echo $dept; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
					</table>
				</div>
				<div id="tabs-2">
					<?php echo $ass1; ?>
					<br><h3>GPA - <?php echo $gpa1;?></h3>
				</div>
				<div id="tabs-3">
					<?php echo $ass2; ?>
					<br><h3>GPA - <?php echo $gpa2;?></h3>
				</div>
				<div id="tabs-4">
					<?php echo $ass3; ?>
					<br><h3>GPA - <?php echo $gpa3;?></h3>
				</div>
			</div>
		</center>
		<?php include('footer.php'); ?>
	</body>
</html>