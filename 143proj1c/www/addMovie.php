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
            <h1>Add new movie</h1>
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
<form action="addMovie.php" method="GET">
		title: <input type="text" name="title" size="35" maxlength="100"><br>
		company: <input type="text" name="company" size="40" maxlength="60"><br>
		year: <input type="text" name="year" size="4" maxlength="4"><br>
		MPAA rating: <select name="rating" style="width: 80px;">
					 <option value="G">"G"</option>
					 <option value="NC-17">"NC-17"</option>
					 <option value="PG">"PG"</option>
					 <option value="PG-13">"PG-13"</option>
					 <option value="R">"R"</option>
					 <option value="surrendere">"surrendere"</option>
					 </select>
		<br>
			Genre: 	<input type="checkbox" name="genre[]" value="Action"> Action
					<input type="checkbox" name="genre[]" value="Adult"> Adult
					<input type="checkbox" name="genre[]" value="Adventure"> Adventure
					<input type="checkbox" name="genre[]" value="Animation"> Animation
					<input type="checkbox" name="genre[]" value="Comedy"> Comedy <br>
					<input type="checkbox" name="genre[]" value="Crime"> Crime
					<input type="checkbox" name="genre[]" value="Documentary"> Documentary
					<input type="checkbox" name="genre[]" value="Drama"> Drama
					<input type="checkbox" name="genre[]" value="Family"> Family
					<input type="checkbox" name="genre[]" value="Fantasy"> Fantasy <br>
					<input type="checkbox" name="genre[]" value="Horror"> Horror
					<input type="checkbox" name="genre[]" value="Musical"> Musical
					<input type="checkbox" name="genre[]" value="Mystery"> Mystery
					<input type="checkbox" name="genre[]" value="Romance"> Romance
					<input type="checkbox" name="genre[]" value="Sci-Fi"> Sci-Fi
					<input type="checkbox" name="genre[]" value="Short"> Short <br>
					<input type="checkbox" name="genre[]" value="Thriller"> Thriller
					<input type="checkbox" name="genre[]" value="War"> War
					<input type="checkbox" name="genre[]" value="Western"> Western



		<br>
		<br>
		<input type="submit" name="submit" value="Add Movie">
</form>

<?php
	if($_GET["submit"])
	{
		$isvalid = true;
		$title = $_GET["title"];
		if(empty($title)){
			echo "Please input the title!<br>";
			$isvalid = false;
		}
		$company = $_GET["company"];
		if(empty($company)){
			echo "Please input the company!<br>";
			$isvalid = false;
		}
		$year = $_GET["year"];
		if(empty($year)){
			echo "Please input the year!<br>";
			$isvalid = false;
		}
		if(!is_numeric($year)){
			echo "please input valid year!<br>";
			$isvalid = false;
		}
		
		//$year = (int)$year;
		//echo "$year";

		$rating = $_GET["rating"];
		$genre = $_GET["genre"];
		//echo "$genre";

		if(!$isvalid)
			exit('invalid input, exit!');

		$db_connection = mysql_connect("localhost", "cs143", "");
		mysql_select_db("CS143", $db_connection);
		if(!$db_connection)
		{
			die('Could not connect: '.mysql_error());
		}

		$query = "update MaxMovieID set id=id+1";
		$rs = mysql_query($query, $db_connection);
		if(!rs)
		{
			die('Could not connect2: '.mysql_error());
		}

		$query = "select * from MaxMovieID";
		$rs = mysql_query($query, $db_connection);
		if(!$rs)
		{
			die('Could not connect3: '.mysql_error());
		}
		$row = mysql_fetch_row($rs);
		$newmid = $row[0];
		
		//echo "$newmid";

		$title = "'".$title."'";
		$company ="'".$company."'";
		$rating = "'".$rating."'";
		

		$query = "insert into Movie values(".$newmid.",".$title.",".$year.",".$rating.",".$company.");";
		echo "$query<br>";
		$rs = mysql_query($query, $db_connection);

		if(!$rs)
		{
			die('Could not connect3: '.mysql_error());
		}

		foreach ($genre as $genreval)
		{
			//echo "$genreval<br>";

			$genreval = "'".$genreval."'";
			$query2 = "insert into MovieGenre values(".$newmid.",".$genreval.");";
			echo "$query2<br>";
			
			$result = mysql_query($query2, $db_connection);

			if(!$result)
			{
				die('Could not connect4: '.mysql_error());
			}
		}
		echo "add successfully!";
		
		mysql_close($db_connection);

	}



?>
</body>
</html>
