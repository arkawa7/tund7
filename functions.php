<?php
	//functions.php
	require_once("../configglobal.php");
	$database = "if15_arkadi_3";
	
	function getCarData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, user_id, number_plate, color from car_plates WHERE deleted is NULL");
		$stmt->bind_result($id, $user_id_from_database, $number_plate, $color);
		$stmt->execute();
		
		// tekitan tühja massivi, kus edaspidi hoian objekte
		$car_array = array();
		
		//tee midagi seni, kuni saame abist rea andmeid
		while($stmt->fetch()){
			//seda siin sees tehakse nii mitu korda kui on ridu
			
			//tekitan objekti, kus hakkan hoidma väärtusi
			$car = new StdClass();
			$car->id = $id;
			$car->plate = $number_plate;
			$car->color = $color;
			$car->user_id = $user_id_from_database;
			
			// lisan massiiv
			array_push($car_array, $car);
			//echo "<pre>";
			//var_dump  ($car_array);
			//echo "</pre><br>";
		}
		
		return $car_array;
		$stmt->close();
		$mysqli->close();
		
	}
	
	function deleteCar($id){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE car_plates SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id);
		if($stmt->execute()){
			
			header("Location: table.php");
		}
		
		$stmt->close();
		$mysqli->close();
		
	}
	
?>