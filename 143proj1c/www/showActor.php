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

	$aid = $_GET['aid'];
	if ($aid == "") {
		echo "Please access this page through a search query.";
		exit;
	}
	
	//	Actor basic information
	$query = sprintf("SELECT * FROM Actor WHERE id = %d", $aid);

	if($rs = mysql_query($query,$db_link)){	
			while($row = mysql_fetch_row($rs)){				
				echo "Name: ";
				echo "$row[2] "."$row[1]"."<br>";
				echo "Gender: ";
				echo "$row[3]"."<br>";
				echo "Date of Birth: ";
				echo "$row[4]"."<br>";
				echo "Date of Death: ";
				
				if(!empty($row[5]))
					echo "$row[5]"."<br>";
				else
					echo "--Still Alive--"."<br><br>";
			
			}
			echo "<br><br><br>";
	}

	// Act in...
	echo "<b>Act in: </b><br>";
	$query = sprintf("SELECT m.id, m.title, ma.role FROM MovieActor AS ma, Movie AS m 
			WHERE ma.aid = %d AND ma.mid = m.id", $aid);

	if($rs = mysql_query($query,$db_link)){	
			while($row = mysql_fetch_row($rs)){				
				echo "<b>Title: </b>";
				echo "<a href='showMovie.php?mid=$row[0]'>$row[1] </a>";
				echo "<b>Role: </b>";
				echo "$row[2]"."<br>";
			}
			echo "<br><br><br>";
	}

	// Direct ...
	echo "<b>Direct: </b><br>";
	$query = sprintf("SELECT m.id, m.title FROM Director d, MovieDirector md, Movie m
			WHERE d.id = %d AND md.did=d.id AND md.mid=m.id", $aid);

	if($rs = mysql_query($query,$db_link)){	
			while($row = mysql_fetch_row($rs)){				
				echo "<b>Title: </b>";
				echo "<a href='showMovie.php?mid=$row[0]'>$row[1] </a>";
			}
			echo "<br><br><br>";
	}
		
	
	mysql_close($db_link);
	echo '</font>';
	
?>

</body>
</html>