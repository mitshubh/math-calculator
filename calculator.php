<!DOCTYPE html>
<html>
<body>

<h1><center>A Simple Math Calculator</center></h1></center></h1>
<center>Written by <b>Shubham Mittal</b></center>
<center>Built using PHP & HTML</center>
<br><br>
<?php
echo "<br>Follow the rules below to create the expression:";
echo "<ul>";
echo "<li>Use only numbers and +,-,* and / operators in the expression.</li>";
echo "<li>Do not use any paranthesis.</li>";
echo "<li>Do not use numbers with leading zeros. The eval() function treats numbers with leading zeros as zero</li>";
echo "<li>Example expressions can be 12*643, 10.06+53.91-23.874/5*29, 12/4 + 56</li>";
echo "<li>Wrong expressions are like 09*09, 12**2, 13+*-3, 12 3+4 etc.</li>";
echo "</ul>";
?>

<form method="GET" action = "calculator.php">
	Enter Expression: <input type="text" name="expr">
	<button>Calculate</button>
</form>

<?php
echo "<br>";
$inputExpr = $_GET["expr"];

$exprRegex = '/^\s*-?\d*\.{0,1}\d+(\s*[*\+\-\/]{0,1}\s*-?\d*\.{0,1}\d+)*\s*$/';
//Strip the input with all the white space
//$inputExpr = preg_replace('/\s+/', '', $inputExpr);
//$exprRegex = '/^-?\d*\.{0,1}\d+([*\+\-\/]{0,1}-?\d*\.{0,1}\d+)*$/';
$boolVal = preg_match($exprRegex, $inputExpr, $match);
//Validate Input Parameters -- length of get request cannot be more than 100 characters
if (strlen($inputExpr)>256) {
	$result = "Invalid Expression! Please try a shorter expression!";
	$flag = false;
} elseif (strlen($inputExpr)==0){
	//Do Nothing
}elseif (!$boolVal || preg_match("/.*([^0-9.]|^)0[0-9]/", $inputExpr)) {
	$result = "Invalid Expression! Please follow the guidelines mentioned to create the expression!";
	echo "<h2>Result</h2> $inputExpr : <b>$result</b>";
} else {
	if (preg_match("/\/\s*0\s*$/", $inputExpr)) {
		$result = "Invalid Expression! Division by zero error";
	}
	else {
		$result = eval('return ' .$inputExpr.';');
		if (strlen($result)==0) {
			$result = "Invalid Expression! Please follow the guidelines mentioned to create the expression!";
		}
	}
	echo "<h2>Result</h2> $inputExpr : <b>$result</b>";
}

?>

</body>
</html>