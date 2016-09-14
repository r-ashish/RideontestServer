<?php

	if(isset($_GET['userId']){
		echo getDetails($_GET['userId']);
	}else{
		echo json_encode(array("message"=>"invalidRequest"));
	}

	function getDetails($userId){
		include("../connect_db.php");
		$query = "SELECT * FROM users WHERE userId='$userId'";
		$users = $connection->query($query);
		$len = $users->num_rows;
		$userData = array();
		if($len != 0){
			$userData["user"] = array();
			$userData["message"] = "userFound";
			$row = mysqli_fetch_assoc($users);
			$userData["user"]["userId"] = (int)$row["userId"];
			$userData["user"]["name"] = $row["name"];
			$userData["user"]["email"] = $row["email"];
			$userData["user"]["phone"] = $row["phone"];
			$userData["user"]["address"] = $row["address"];
		}else{
			$userData["message"] = "userNotFound";
		}
		return json_encode($userData);
	}
?>