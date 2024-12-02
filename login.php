<?php

session_start();
include "db.php";
if (isset($_POST['uname']) && isset($_POST['password'])){
	function validate($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;

	}

	$uname = validate($_POST['uname']);
	$password = validate($_POST['password']);

	if (empty($uname)) {
		header("Location: index.php?error= User Name is required");
		exit();
	}else{
		$sql = "SELECT * FROM  users WHERE user_name = '$uname' AND password = '$password'";

		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) === 1){

			$row = mysqli_fetch_assoc($result);
			
			if($row['user_name'] === $uname && $row['password'] === $password){
				$_SESSION['user_name'] = $row['user_name'];
				$_SESSION['tag'] = $row['tag'];
				$_SESSION['id'] = $row['id'];
				if($uname==="admin")
					header("Location: editorPc.php");
				else
					header("Location:viewerPc.php");
				exit();	
			}
			else{
			header("Location: index.php?error= Incorect Username or Password");
			exit();	
			}
		}
		else{
		header("Location: index.php?error= Incorect Username or Password");
		exit();	
		}
	}

}else{
	header("Location: index.php");
	exit();
}
 ?>