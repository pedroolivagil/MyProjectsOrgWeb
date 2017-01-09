<?php
header('Content-type: text/plain; charset=utf-8');
//dividir en otros arrays de 2 elementos de longitud
$colores = array("rojo", "azul", "amarillo", "verde", "negro", "blanco");
echo "Array original";
var_export ($colores);
echo "Arrays resultantes";
print_r(array_chunk($colores, 2));
 
//dividir en otros arrays de 4 elementos de longitud
$colores = array("rojo", "azul", "amarillo", "verde", "negro", "blanco");
echo "Array original";
var_export ($colores);
echo "Arrays resultantes";
print_r(array_chunk($colores, 4));
?>