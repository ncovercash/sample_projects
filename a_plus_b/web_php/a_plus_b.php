<html>
	<body>
<?php
if (isset($_GET["input"]) && !empty($_GET["input"]) && count(preg_split("/\D+/", $_GET["input"])) >= 2) {
	echo "Sum is: ".(preg_split("/\D+/", $_GET["input"])[0] + preg_split("/\D+/", $_GET["input"])[1])."
	</body>
</html>";
	die();
}
?>
		<form action="">
			<p>Input 2 numbers seperated by a space</p>
			<input type="text" name="input" />
			<input type="submit" name="" value="Submit" />
		</form>
	</body>
</html>
