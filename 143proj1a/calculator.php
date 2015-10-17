<html>	
<body>
<h1>Calculator</h1>	
<p>(4/7/2015 By Hongchen Li)</p>
<form action="<?php echo $_SEVER['PHP_SELF']?>"	method="get">
Type an expression in the following box (e.g., 10.5+20*3/25).<br/><br/>
<input	type="text"	name="exp" />
<input type="submit" value="Calculate"/><br/>
</form>	
<p>
<b>Attention:</b>
<ui>
<li>Only numbers and +,-,* and / operators are allowed in the expression.</li>
<li>The evaluation follows the standard operator precedence.</li>
<li>The calculator does not support parentheses.</li>
<li>Spaces are allowed.</li>
</ui></p><br>
<?php
$exp = 	$_GET["exp"];
$expr = $exp;
$err = 0;
$exp = preg_replace("/\s/","",$exp);// spaces in expressions are allowed
if ($exp !=""){
	// check for parentheses
	if (preg_match("/[()]/",$exp))
		$err = 1;
	// check for characters besides operators and numbers(including integers and floats)
	if (preg_match("/[^.\d\+\*\/-]/",$exp))
	 	$err = 2; 
	// check for uncomplete floats
	if (preg_match("/[^\d][.]\d+/",$exp) || preg_match("/\d+[.][^\d]/",$exp) || preg_match("/^[.]\d/",$exp))
		$err = 3;
	// if(preg_match("/^[.]\d/",$exp))
	// 	$err = 4;
	// consecutive characters of . + * /are invalid, -+ -* -/ are also valid
	if(preg_match("/[.\+\*\/]{2,}/",$exp) || preg_match("/-[.\+\*\/]/",$exp) || preg_match("/--{2,}/",$exp))
		$err = 4;
	// replace + for --
	if(preg_match("/--/",$exp))
		$exp = preg_replace("/--/","+",$exp);

	if ($err)
		echo "<p><h3>Invaild Expression!</h3></p>";
	else {
		if(preg_match("/\/[0]/",$exp))
			echo "<p><h3>Division by zero error!</h3>";
		else{
				eval("\$ans = $exp;");
				echo "<h2>Result:</h2>".$expr." = ".$ans."<br>";
			}	
		}		
}
?>	
</body>	
</html>