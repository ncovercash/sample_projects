<!DOCTYPE html>
<!DOCTYPE html>
<html>
	<head>
		<title>15 Puzzle</title>
		<link rel="stylesheet" href="15_puzzle.css">
	</head>
	<body>
		<table>
		<?php
		$index = 0;
		for ($row=1; $row <= 4; $row++) {
			echo "<tr>";
			for ($col=1; $col <= 4; $col++) {
				echo "<td index=\"$index\" row=\"$row\" col=\"$col\">-</td> ";
			}
			echo "</tr>";
		}
		?>
		</table>
	</body>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	<script src="15_puzzle.js"></script>
</html>