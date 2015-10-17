
<html>
<head>
	<meta charset="utf-8">
	<title>Query MySQL</title>
	<h2>Query MySQL</h2>
	<h4>Project 1B </h4>
	<br>
</head>
<body>
<form action="<?php echo $_SEVER['PHP_SELF']?>"	method="get"><br>
<TEXTAREA name="area" ROWS=10 COLS=60 placeholder = "Please type the query here.">
<?php echo $_GET['area'];?>
</TEXTAREA><br><br>
<input type="submit" value="submit">
</form>

<h3>Results from MySQL:</h3>
<?php
	if(!$query = $_GET['area']){
		echo "Query was empty.";
	}else{
	$db_link = mysql_connect("localhost","cs143","");
	mysql_select_db("CS143",$db_link);

	if (!$db_link) {
		die('Could not connect: '.mysql_error());
	}
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		$query = $_GET['area'];
		if($rs = mysql_query($query,$db_link)){
			echo "<table border=3>";		
				echo "<tr>";
				for ($i=0; $i < count($row); $i++) { 
					$rn = mysql_field_name($rs,$i);
					echo "<th>$rn</th>";
				}
				echo "</tr>";
				$field = 1;
			while($row = mysql_fetch_row($rs)){
				if($field){
					echo "<tr>";
					for ($i=0; $i < count($row); $i++) { 
						$rn = mysql_field_name($rs,$i);
					echo "<th>$rn</th>";
					}
					echo "</tr>";
					$field = 0;
				}
				echo "<tr>";
				for ($i=0; $i < count($row); $i++) { 
					echo "<td>$row[$i]</td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		}
	}
	mysql_close($db_link);}
?>
</body>
</html>