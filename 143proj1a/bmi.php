<html>	
<body>	
<form action="bmi.php"	method="get"><br/>
<center><h3>Body Mass Index Calculator</h3>
<p>(4/7/2015 By Hongchen Li)</p>
Height (m):	<input	type="text"	name="h" value="<?php echo $_GET['h'];?>" size=5 maxlength=3/>	
Weight (Kg):<input	type="text"	name="w" value="<?php echo $_GET['w'];?>" size=5 maxlength=3/>
<br/><br/>
BMI:<input type="text" name="bmi" 
value="<?php 
global $w, $h, $err;
$w = $_GET["w"];
$h = $_GET["h"];
$err  = 0;
// characters besides numbers, dots, spaces are invalid
if(preg_match("/[^.\s\d]/",$w) || preg_match("/[^.\s\d]/",$h))
	$err = 1;
// uncomplete floats for $w are invalid
if (preg_match("/[^\d][.]\d+/",$w) || preg_match("/\d+[.][^\d]/",$w) || preg_match("/^[.]\d/",$w))
	$err = 2;
// uncomplete floats for $w are invalid
if (preg_match("/[^\d][.]\d+/",$h) || preg_match("/\d+[.][^\d]/",$h) || preg_match("/^[.]\d/",$h))
	$err = 3;
if($_GET["w"] == 0 || $_GET["h"] == 0 || $err)
	echo 0;
else
	printf("%.2f",$_GET["w"]/(($_GET["h"]*$_GET["h"]))) ;
?>" size=5 readonly/>
<br/><br/>
<input type="submit" value="Calculate BMI"/>	
</center>
</form>	
<hr>
<h3>Report:</h3>
<?php
if($w == 0 || $h == 0 || $err){
	echo "Wrong input!<br/>";
}
else{
	$bmi = $_GET["w"]/(($_GET["h"]*$_GET["h"]));
	if($bmi <= 18.5){	
		echo "You are underweight.<br/>";
	}elseif ($bmi <= 24.9 && $bmi >= 18.5) {
		echo "You are normal weight.<br/>";
	}elseif ($bmi <= 29.9 && $bmi >= 24.9) {
		echo "You are overweight.<br/>";
	}elseif ($bmi <= 39.9 && $bmi >= 29.9) {
		echo "You are obesity.<br/>";
	}elseif ($bmi >= 39.9) {
		echo "You are morbidly obesity.<br/>";
	}
}
?>	
</body>	
</html>