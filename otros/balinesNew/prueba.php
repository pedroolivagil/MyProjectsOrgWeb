<?php
define("PULGADAS","25.4");
define("DP","160");

// Variables
$mmAncho=241.2;
$mmAlto=185.7;
$resAncho=2048;
$resAlto=1536;
$d=9.6;
echo '<link rel="stylesheet" type="text/css" href="css/fonts.css">';
echo "<style>.iframe {font-family:'agency_fbregular'; font-size:1.3em;}</style>";
echo '<span class="iframe">';
echo "<br />mm ancho = ".$mmAncho;
echo "<br />mm ancho = ".$mmAlto;
echo "<br />Resolucion ancho = ".$resAncho;
echo "<br />Resolucion ancho = ".$resAlto;
echo "<br />Tamaño en pulgadas = ".$d;
echo "<br /><br />";
echo '</span>';
// Calculamos las pulgada
$a=round($mmAlto/PULGADAS,1);	// alto
$b=round($mmAncho/PULGADAS,1);	// ancho

$y=round($d/pow((pow($a,2)/pow($b,2))+1,.5),2);
$x=round(($a*$y)/$b,1);

$denHor=round($resAncho/$x,0);	// densidad horizontal
$denVer=round($resAlto/$y,0);	// densidad vertical

$dpHor=round(($resAncho*DP)/$denHor,0);	// DP horizontal
$dpVert=round(($resAlto*DP)/$denVer,0);	// DP vertical
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8" />
</head>
<body>
<br />Pasem els milímetres a polsades: 
<blockquote>
A = <?php echo $mmAlto; ?>/<?php echo PULGADAS; ?> = <?php echo $a; ?>"
<br />
B = <?php echo $mmAncho; ?>/<?php echo PULGADAS; ?> = <?php echo $b; ?>"
</blockquote>
Calculem y =  <?php echo $d; ?> / (A<sup>2</sup>/B<sup>2</sup> +1)<sup>1/2</sup> = 5 / (<?php echo $a; ?><sup>2</sup>/<?php echo $b; ?><sup>2</sup> + 1)<sup>1/2</sup> = <?php echo $y; ?>"
<br />Calculem x = A*y/B = <?php echo $a; ?>•<?php echo $y; ?>/<?php echo $b; ?> = <?php echo $x; ?>"
<br />Densitat en horitzontal = Pix Horizontals / y = <?php echo $resAncho; ?> / <?php echo $x; ?> = <?php echo $denHor; ?> dpi
<br />Densitat en vertical = Pix Verticals / x = <?php echo $resAlto; ?> / <?php echo $y; ?> = <?php echo $denVer; ?> dpi
<br />Dimensions físiques en dp: 
<br />horitzontal dp = Pix Horizontals * <?php echo DP; ?>  / Dens. Horizontal = <?php echo $resAncho; ?> * <?php echo DP; ?>  / <?php echo $denHor; ?> = <?php echo $dpHor; ?> dp
<br />vertical dp =  Pix Verticals * <?php echo DP; ?>  / Dens. Vertical = <?php echo $resAlto; ?> * <?php echo DP; ?>  / <?php echo $denVer; ?> = <?php echo $dpVert; ?> dp
</body>
</html>