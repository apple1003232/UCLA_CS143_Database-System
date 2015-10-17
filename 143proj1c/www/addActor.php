<html>
<head>
	<meta charset="utf-8" />
	<a href="http://192.168.56.20/~cs143/"></a>
	<title>Movie Database | CS143 Project 1C By Hongchen Li, Shengzhi Jiang</title>
	<link rel="stylesheet" href="./styles.css" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lobster" />
</head>

<body>

<header>
            <h1>Add new actor/director</h1>
            <h2>CS143 Project 1C By Hongchen Li, Shengzhi Jiang</h2>
    </header>
    <nav>
            <ul class="fancyNav">
                <li id="home"><a href="search.php" class="homeIcon">Home</a></li>
                <li id="addActor"><a href="addActor.php">Add Actor</a></li>
                <li id="addMovie"><a href="addMovie.php">Add Movie</a></li>
                <li id="addMovieRelation"><a href="actorMovieRelation.php">Add Actor Role</a></li>
            </ul>
            <br><br>
            <form method="get" action="search.php">	
				<input	type="text"	name="keyword" size=35 placeholder = "Find Movies, Actors and more...">
				<input type="submit" value="Search">
			</form>
            	
    </nav>
    <br>
 <center>   
<form action="addActor.php" method="GET">
		Identity: <input type="radio" name="identity" value="actor" checked> Actor
				  <!-- <input type="radio" name="identity" value="director"> Director --> <br>
	    First Name: <input type="text" name="firstname" size="10" maxlength="20"><br>
	    Last Name: <input type="text" name="lastname" size="10" maxlength="20"><br>
	    Sex: <input type="radio" name="sex" value="male"> Male
	         <input type="radio" name="sex" value="female"> Female<br>
	    Date of Birth: <input type="text" name="dob" size="10" maxlength="20">(YYYY-MM-DD)<br>
	    Date of Die: <input type="text" name="dod" size="10" maxlength="20">(YYYY-MM-DD, leave blank if alive now)<br>
	    <input type="submit" name="submit" value="add it!">
</form>

<?php
if($_GET["submit"])
{
	$isvalid = true;
	if(empty($_GET["firstname"])){
		echo "Please input the first name!<br>";
		$isvalid = false;
	}
	if(empty($_GET["lastname"])){
		echo "Please input the last name!<br>";
		$isvalid = false;
	}
	if(empty($_GET["sex"])){
		echo "Please choose the sex<br>";
		$isvalid = false;
	}
	if(empty($_GET["dob"])){
		echo "Date of birth is required.<br>";
		$isvalid = false;
	}
	else
	{
		$tmpdate=$_GET["dob"];
		if($tmpdate[4]=='-' && $tmpdate[7]=='-')
		{
			$year=substr($tmpdate, 0, 4);
			$month=substr($tmpdate, 5, 2);
			$day=substr($tmpdate, 8, 2);
			if(!checkdate($month, $day, $year)){
				echo "Date of Birth is not in a valid format.<br>";
				$isvalid = false;
			}
		}

	}
	if($_GET["dod"])
	{
		$tempdate=$_GET["dod"];
		if($tempdate[4]=='-' && $tempdate[7]=='-')
		{
			$year=substr($tempdate, 0, 4);
			$month=substr($tempdate, 5, 2);
			$day=substr($tempdate, 8, 2);
			if(!checkdate($month, $day, $year)){
				echo "Date of Die is not in a valid format.<br>";
				$isvalid = false;
			}
		}
	}

	if(!$isvalid)
		exit('invalid input, exist');

	$db_connection = mysql_connect("localhost", "cs143", "");
	mysql_select_db("CS143", $db_connection);
	if(!$db_connection)
	{
		die('Could not connect: '.mysql_error());
	}

	$query = "update MaxPersonID set id=id+1";
	$rs = mysql_query($query, $db_connection);
	if(!rs)
	{
		die('Could not connect2: '.mysql_error());
	}

	$query = "select * from MaxPersonID";
	$rs = mysql_query($query, $db_connection);
	if(!$rs)
	{
		die('Could not connect3: '.mysql_error());
	}
	$row = mysql_fetch_row($rs);
	$pid = $row[0];

	// input new query
	$lname = $_GET["lastname"];
	//$cle = str_replace("'", "\'", $lname);
	//$lname = "'".$cle."'";
	$lname = "'".$lname."'";

	$fname = $_GET["firstname"];
	//$cla = str_replace("'", "\'", $fname);
	//$fname = "'".$cla."'";
	$fname = "'".$fname."'";

	if($_GET["sex"] == "male")
		$sex = "'Male'";
	else 
		$sex = "'Female'";

	$dod = $_GET["dod"];
	if(empty($dod))
		$dod = 'NULL';
	//$dod ="'"."\'".$dod."\'"."'";
	else
		$dod = "'".$dod."'";

	$dob=$_GET["dob"];
	$dob="'".$dob."'";
	// echo "dob now is ";
	// echo $dob;

	//$dob = "''".$dob."''";
	//echo $dob;
	

	// if($_GET["identity"]=="actor")
	// 	$table = "Actor";
	// else
	// 	$table = "Director";

	$query = "insert into Actor values (".$pid.",".$lname.",".$fname.",";
	
	// if($table == "Actor")
	$query = $query.$sex.",";

	$query = $query.$dob.",".$dod.")";
	//echo $query; 
	
	$result = mysql_query($query, $db_connection);
	if(!$result)
	{
		die('Could not connect4: '.mysql_error());
	}
	echo "add successfully!";
	mysql_close($db_connection);
}

?>

</body>
</html>