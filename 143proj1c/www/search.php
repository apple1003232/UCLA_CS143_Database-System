<!DOCTYPE html>
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
    <br>

    

<?php
	
	// Create connection	
	$db_link = mysql_connect("localhost","cs143","");
	
	// Check connection
	if (!$db_link) {
		$errmsg = mysql_error($db_link);
		print "Connection failed: $errmsg <br/>";
		exit(1);
	}
	if ($_SERVER["QUERY_STRING"] == "") {
		exit;
	}
	mysql_select_db("CS143",$db_link);

	
	if($_SERVER["REQUEST_METHOD"]=="GET"){
		
		$flag = 0;
		$keyword = $_GET["keyword"];
		if(preg_match("/^(\s)+$/",$keyword)){
			echo "<br><center>Enter a word or phrase to search on.<br></center>";
			exit;
		}

		echo '<font size="4" color="white"><center>Results for "'. $_GET["keyword"].'".'.'<br><br></center></font>';		
		if(preg_match("/[^\s\w]/",$keyword)){
			echo "<center>None.<br></center>";
			exit;
		}

		// Multi-word search
		if(preg_match("/\s/",$keyword)){
			// Extract each word to $kw_match
			$keyword = $keyword." ";
			preg_match_all("/\w+(?=\s)/",$keyword,$kw_match);
			
			// Search in Movies
			// Create an array to store Movies' title
			$query = "SELECT id,title from Movie";
			$rs = mysql_query($query,$db_link);
			$i = 0;
			while ( $row = mysql_fetch_row($rs)) {
				$mid[$i] = $row[0];
				$str[$i] = sprintf("%s", $row[1]);
				$i++;				
			}

			echo '<font size="3" color="white"><center>Titles: '.'<br></font>';

			// Check if Movies' title matches keywords
			for ($j=0; $j < count($str) ; $j++) {
				$i = 0; 
				$pattern = sprintf('/%s/i', $kw_match[0][$i]);
				while(preg_match($pattern, $str[$j], $match) && $i < count($kw_match[0])){
					$i ++;
					$pattern = sprintf('/%s/i', $kw_match[0][$i]);
				}

				// All matches. Find the actor.
				if($i >= count($kw_match[0])){
					//echo $str[$j]."<br>";//create a hyperlink
					echo "<center><a href='showMovie.php?mid=$mid[$j]'>$str[$j]</a><br /></center>";
					$flag = 1;
				}
					
			}
			if($flag != 1)
				echo "<center>None."."<br></center>";

			// Search in Actors
			// Create an array to store Actors' first and last name
			$query = "SELECT id,first, last from Actor";
			$rs = mysql_query($query,$db_link);
			$i = 0;
			while ( $row = mysql_fetch_row($rs)) {
				$aid[$i] = $row[0];
				$str[$i] = sprintf("%s %s ", $row[1], $row[2]);
				$i++;				
			}

			echo '<font size="3" color="white"><center>'.'Names: '.'<br>'.'</center></font>';

			// Check if Actors' name matches keywords
			for ($j=0; $j < count($str) ; $j++) {
				$i = 0; 
				$pattern = sprintf('/%s/i', $kw_match[0][$i]);
				while(preg_match($pattern, $str[$j], $match) && $i < count($kw_match[0])){
					$i ++;
					$pattern = sprintf('/%s/i', $kw_match[0][$i]);
				}

				// All matches. Find the actor.
				if($i >= count($kw_match[0])){
					$flag = 2;
					//echo $str[$j]."<br>";//create a hyperlink
					echo "<center><a href='showActor.php?aid=$aid[$j]'>$str[$j]</a><br /></center>";

				}
					
			}
			if($flag != 2)
				echo "<center>None."."<br></center>";
		}

		// One word search
		else{
			$keyword = mysql_real_escape_string("%".$keyword."%");
		
			// Search in Movies
			echo '<center><b>'.'Titles: '.'<br>'.'</b></center>';

			$query = sprintf("SELECT id, title, year, rating, company FROM Movie 
				WHERE title LIKE '%s'", $keyword);
			
			if($rs = mysql_query($query,$db_link)){
				$flag = 3;

				while($row = mysql_fetch_row($rs)){				
					echo "<center><a href='showMovie.php?mid=$row[0]'>$row[1] </a><br /></center>";
				}
				echo "<center><br><br><br></center>";
			}

			if($flag != 3)
				echo "<center>None."."<br></center>";

			// Search in Actors
			echo '<center><b>'.'Names: '.'<br>'.'</b></center>';

			$query = sprintf("SELECT id, first, last, sex, dob, dod FROM Actor 
				WHERE last LIKE '%s' OR first LIKE '%s'", $keyword, $keyword);

			if($rs = mysql_query($query,$db_link)){	

				$flag = 4;		
				
				while($row = mysql_fetch_row($rs)){				
					echo "<center><a href='showActor.php?aid=$row[0]'>$row[1] $row[2]</a><br /></center>";
				}
				echo "<br><br><br>";
			}
			if($flag != 4)
				echo "<center>None."."<br></center>";
		}
	}
	mysql_close($db_link);
	
?>
</body>
</html>