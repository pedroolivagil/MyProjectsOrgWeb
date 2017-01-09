<?php
   class Vegetable {
       private $edible;
       private $color;
    
       function Vegetable($edible, $color="green") {
           $this->edible = $edible;
           $this->color = $color;		   
       }
    
       function isEdible() {
           return $this->edible;
       }
    
       function getColor() {
           return $this->color;
       }     
    }    
?>