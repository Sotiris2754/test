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
		<h2>Επιμέλεια εκθέσεων στο Τμήματος Τεχνών Ήχου και Εικόνας</h2>
		<?php if (isset($_GET['error'])) {?>
			<p class= "error"><?php echo $_GET['error']; ?></p>
		<?php } ?>
		<label>User Name</label>
		<input type="text" name="uname" placeholder="Username"><br>
	
		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>
		<!-- <a href="test.php"></a> -->
		<button type="submit">Login</button>

	</form>
</body>
</html>