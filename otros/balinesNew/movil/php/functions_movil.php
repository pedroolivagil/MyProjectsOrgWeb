<?php
$dbhost='localhost';
$dbname='balinesnew';
if($_SERVER['SERVER_NAME']!='localhost'){
	$dbuser='mybalinesc';
	$dbpasswd='Y4M9M1Zi';
}else{
	$dbuser='root';
	$dbpasswd='20081991_A';
}
$tituloWeb='Balines';
$db=mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbname);
mysqli_query($db,"SET NAMES 'utf8'");
@mysqli_set_charset('utf8');
@header("Content-type: text/html; charset=utf8");

?>