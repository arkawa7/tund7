<?php
	require_once("edit_functions.php");
	
	if(isset($_GET["edit_id"])){
		echo $_GET["edit_id"];
		
		$car = getEditData($_GET["edit_id"]);
		var_dump($car);
		
		
	}else{
		echo "VIGA";
		//die()
		
		header("Location: table.php");
	}
?>


<h2>Lisa autonumbrimärk</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<label for="number_plate">Auto numbrimärk</label>
  	<input id="number_plate" name="number_plate" type="text"  value=""><br><br>
	<label for="color">Värv</label><br>
  	<input id="color" name="color" type="text"  value=""><br><br>
  	<input type="submit" name="add_plate" value="Salvesta">
  </form>