<html>
	<head>
		<title>Vegetable Tester</title>
	</head>
	<body>
		<?php
			require_once("vegetable.php");
			$veg1 = new Vegetable(true);
			$veg2 = new Vegetable(true,"blue");
			
			echo $veg1->isEdible()."<br/>";
			echo $veg1->getColor()."<br/>";
			echo $veg2->isEdible()."<br/>";
			echo $veg2->getColor()."<br/>";
		?>
	</body>
</html>

