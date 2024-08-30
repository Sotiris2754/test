<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>LOGIN PAGE</title>
</head>
<body>
	<form action="login.php" method="post">
		<h2>LOGIN</h2>

		<?php if (isset($_GET['error'])) {?>
			<p class= "error"><?php echo $_GET['error']; ?></p>
		<?php } ?>

		<!-- <label>User Name</label> -->
		<!-- <button type="submit">Admin</button> -->
		<!-- <input type="text" name="uname" placeholder="Username"><br> -->
	
		<!-- <label>Password</label> -->
		<!-- <input type="password" name="password" placeholder="Password"><br> -->

		<!-- <button type="submit">Password</button> -->

	<div class="button-container">
		<a href="index.php">EDITOR</a>
		<a href="database.php">VIEWER</a>
        <!-- <button class="button2" type="submit">EDITOR</button> -->
        <!-- <button class="button2" type="submit" >VIEWER</button> -->
    </div>

	</form>
</body>
</html>