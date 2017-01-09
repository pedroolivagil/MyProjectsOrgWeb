<html>
	<head>
		<title>Vegetable Tester</title>
	</head>
	<body>
		<?php
			class Vegetable {
			   private $edible;
			   private $color;
			   private static $numVegetables = 0;
			   public static $numVegetablesPublic = 0;
			
			   function Vegetable($edible, $color="green"){
				   $this->edible = $edible;
				   $this->color = $color;
				   self::$numVegetables++;
				   self::$numVegetablesPublic++;
			   }
			
			   function isEdible() {
				   return $this->edible;
			   }
			
			   function getColor(){
				   return $this->color;
			   }
			   
			   static function getNumVegetables() {
					return self::$numVegetables;
			   }			 
			}

			$veg1 = new Vegetable(true);
			$veg2 = new Vegetable(true,"blue");

			echo $veg1->isEdible()."<br/>";
			echo $veg1->getColor()."<br/>";
			echo $veg2->isEdible()."<br/>";
			echo $veg2->getColor()."<br/>";
			echo Vegetable::getNumVegetables();
			echo Vegetable::$numVegetablesPublic;
		?>
	</body>
</html>