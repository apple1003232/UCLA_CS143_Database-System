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
            <h1>Add actor-movie relations</h1>
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

<form action="actorMovieRelation.php" method="GET">
	Movie: <select name="mid" style="width: 180px;">
		<?php
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		if(!$db_connection)
		{
			die('Could not connect: '.mysql_error());
		}
		$query = "select id,title from Movie order by title";
		$rs = mysql_query($query, $db_connection);
		if(!rs)
		{
			die('invalid query: '.mysql_error());
		}
		while($row = mysql_fetch_row($rs))
		{
			echo "<option value='".$row[0]."'>".$row[1]."</option>";
		}
		mysql_close($db_connection);
		?>
		</select><br>
	Actor: <select name="aid" style="width: 185px;">
		<?php
		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		if(!$db_connection)
		{
			die('Could not connect: '.mysql_error());
		}
		$query = "select id,first,last from Actor order by first,last";
		$rs = mysql_query($query, $db_connection);
		if(!rs)
		{
			die('invalid query: '.mysql_error());
		}
		while($row = mysql_fetch_row($rs))
		{
			echo "<option value='".$row[0]."'>".$row[1]." ".$row[2]."</option>";
		}
		mysql_close($db_connection);
		?>
		</select><br>
	Role: <input type="text" name="role" size="20" maxlength="50"><br><br>
	<input type="submit" name="submit" value="add relation">
</form>

<?php
	if($_GET["submit"])
	{

		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		if(!$db_connection)
		{
			die('Could not connect: '.mysql_error());
		}

		$mid = $_GET["mid"];
		//echo "$mid";
		$mid = "'".$mid."'";
		//echo "$mid";
		$aid = $_GET["aid"];
		//echo "$aid";
		$aid = "'".$aid."'";
		//echo "$aid";
		$role = $_GET["role"];
		//echo "$role";
		$role = "'".$role."'";

		$query = "insert into MovieActor values (".$mid.",".$aid.",".$role.");";
		$rs = mysql_query($query, $db_connection);
		if(!$rs)
		{
			die('Insert relation failure: '.mysql_error());
		}

		echo "Add movie to actor relations Successfully ";

		mysql_close($db_connection);
	}


?>
</body>
</html>


