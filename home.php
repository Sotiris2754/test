<?php 
session_start();


if(isset($_SESSION['id']) && isset($_SESSION['user_name'])){

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>HOME</title>
</head>
<body>
<h1> Hello user.../ <?php echo $_SESSION['tag'] ?></h1> 

<!-- <a href="logout.php">Logout</a> -->
	<div class="button-container">
		<a href="index.php">EDITOR</a>
		<a href="db.php">VIEWER</a>
        <!-- <button class="button2" type="submit">EDITOR</button> -->
        <!-- <button class="button2" type="submit" >VIEWER</button> -->
    </div>
</body>
</html>


<?php 
}else{
	header("Location: index.php");
	exit();
}

?>