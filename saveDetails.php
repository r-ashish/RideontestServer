<?php
	$paramsArray = (array)json_decode(file_get_contents("php://input"));
	$name = $_POST["name"];
	$email = $paramsArray["email"];
	$phone = $paramsArray["phone"];
	$address = $paramsArray["address"];
	$errorResponse = json_encode(array("message"=>"invalidRequest"));


	if(!isset($paramsArray["userId"]) || 
		!isset($paramsArray["title"]) || 
		!isset($paramsArray["description"])){
		echo $errorResponse;		
	}else{
		echo saveDetails($name, $email, $phone, $address);
	}

	function saveDetails($name, $email, $phone, $address){
		include('../connect_db.php');
	
		$query = "INSERT INTO users(name,email,phone,address) VALUES('$name','$email','$phone','$address')";
		$emailCheckQuery = "SELECT * from users where email = '$email'";
		$phoneCheckQuery = "SELECT * from users where phone = '$phone'";

		$emailCheck = $connection->query($emailCheckQuery);
		$phoneCheck = $connection->query($phoneCheckQuery);


		if($emailCheck->num_rows > 0){
			$error = array('message' => "emailAlreadyRegistered");
			return json_encode($error);
		}else if($phoneCheck->num_rows > 0){
			$error = array('message' => "phoneAlreadyRegistered");
			return json_encode($error);
		}else{
			$save = $connection->query($query);
			if($save)
				return json_encode(array("message"=>"detailsSaved"));
			else
				return json_encode(array("message"=>"failedToSaveDetails"));
		}
	}
?>