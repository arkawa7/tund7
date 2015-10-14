<?php
	require_once("../configglobal.php");
	$database = "if15_arkadi_3";
	

	function getEditData($edit_id){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT number_plate, color FROM car_plates WHERE id=? AND deleted IS NULL");
		$stmt->bind_param("i",$edit_id);
		$stmt->bind_result($number_plate, $color);
		$stmt->execute();
		
		$car = new stdclass();
		
		//kas sain ühe rea andmeid kätte
		if($stmt->fetch()){
			//sain
			$car->number_plate = $number_plate;
			$car->color = $color;
		}else{
			//ei saanud
			header("location: table.php");		
		}
		
		return $car;
		
		$stmt->close();
		$mysqli->close();
	}
	

?>