<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "v-corfu";


$conn = new mysqli($servername,$username,$password,$database);

if($conn->connect_error){
	die("Conection failed: ");
}

$sql = "SELECT * FROM apps_collab_exh";
$result = $conn->query($sql);

// if(!result){
// 	die("Invalid query:");
// }

while($row = $result->fetch_assoc()){
	echo "<tr>
		<td>Id: $row[id]</td>
		<td>Exhibit $row[exhibit]</td>,
	</tr>";
}

?>
