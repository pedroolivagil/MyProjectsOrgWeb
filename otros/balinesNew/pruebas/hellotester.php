<html>
<body>
<?php
class Hello {	
	private $greeting;	
	function getGreeting() {
		return $this->greeting;
	}
	
	function setGreeting($greeting) {
		$this->greeting = $greeting;
	}
	
	function Hello($greeting) {
		$this->greeting = $greeting;
	}
	
	function speak(){
		for ($i=0; $i < strlen($this->greeting); $i++){
			echo $this->greeting."<br/>";
		}
	}
}
if(isset($_GET["btnhello"]) && isset($_GET["message"])){
	$hello = new Hello($_GET["message"]);
	$hello->speak();
}

?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
	Escriu un missatge: <input type="text" name="message" />
	<input type="submit" name="btnhello" />
</form>
</body>
</html>