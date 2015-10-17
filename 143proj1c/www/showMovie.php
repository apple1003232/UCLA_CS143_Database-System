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
            <h1>Welcome to Movie Database!</h1>
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

<?php
	echo '<font color="white">';
	// Create connection	
	$db_link = mysql_connect("localhost","cs143","");
	
	// Check connection
	if (!$db_link) {
		$errmsg = mysql_error($db_link);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}
	if ($_SERVER["QUERY_STRING"] == "") exit;
	mysql_select_db("CS143",$db_link);

	$mid = $_GET['mid'];
	if ($mid == "") {
		echo "Please access this page through a search query.";
		exit;
	}
	
	//	Movie basic information
	/*$query = sprintf("SELECT m.title, m.year, m.rating, m.company, mg.genre, d.first, d.last
		FROM Movie m, MovieGenre mg, Director d, MovieDirector md 
		WHERE m.id = %d AND mg.mid = m.id AND md.mid = m.id AND d.id = md.did", $mid);
*/
	$query = sprintf("SELECT distinct m.title, m.company, m.year, m.rating
		FROM Movie m WHERE m.id = %d", $mid);

	if($rs = mysql_query($query,$db_link)){
			while($row = mysql_fetch_row($rs)){	
			$out = "Title: "."$row[0] "."<br>"."Producer: $row[1]"."<br>";
			$out = $out."Year: $row[2]"."<br>"."MPAA Rating: $row[3]"."<br>"."Genre: ";
			}
	}

	// Movie genre
	$query = sprintf("SELECT genre FROM MovieGenre WHERE mid = %d", $mid);

	if($rs = mysql_query($query,$db_link)){
		while($row = mysql_fetch_row($rs)){
			$out = $out." $row[0]";
		}
		$out = $out. "<br>"."Director: ";
	}
	echo $out;

	// Movie director
	$query = sprintf("SELECT d.id, d.first, d.last FROM MovieDirector md, Director d 
		WHERE md.mid = %d AND d.id = md.did", $mid);

	if($rs = mysql_query($query,$db_link)){
		while($row = mysql_fetch_row($rs)){
			echo "<a href='showDirector.php?did=$row[0]'>$row[1] $row[2]; </a>";
		}
	}

	echo "<br><br>";

	//	Actors in this Movie
	$query = sprintf("SELECT a.id, ma.role, a.first, a.last FROM MovieActor ma, Actor a 
		WHERE ma.mid = %d AND ma.aid = a.id", $mid);

	if($rs = mysql_query($query,$db_link)){	
		echo "<b>Actors: </b><br>";
			while($row = mysql_fetch_row($rs)){				
				echo "<a href='showActor.php?aid=$row[0]'>$row[2] $row[3] </a>";
				echo "<b>Role: </b>";
				echo "$row[1]"."<br>";
			}

				echo "<br><br><br>";
	}

	
	
	
	mysql_close($db_link);
	echo '</font>';
?>

</body>
</html>