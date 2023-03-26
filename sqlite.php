<?php
// Open a new SQLite database file or connect to an existing one
$db = new SQLite3('test.db');


//Check if bases table exists
$tableExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='bases'");


// Create a table called "mytable" with 3 columns
if(!$tableExists){
$db->exec('CREATE TABLE bases (id INTEGER PRIMARY KEY, colorBase TEXT, placed BOOLEAN DEFAULT 0, exhibit TEXT)');


//Insert data into the table
// $db->exec("INSERT INTO bases (colorBase) VALUES ('Yellow')");
// $db->exec("INSERT INTO bases (colorBase) VALUES ('Red')");
// $db->exec("INSERT INTO bases (colorBase) VALUES ('Green')");
// $db->exec("INSERT INTO bases (colorBase) VALUES ('Blue')");
 }

// if(ISSET($_POST['action'])&& $_POST['action']=="store"){

$colorBase = $_POST['colorBase'];
$exhibit = $_POST['exhibit'];

$stmt = $db->prepare("INSERT INTO bases (colorBase, exhibit) VALUES (:colorBase, :exhibit)");

$stmt->bindParam(':colorBase', $colorBase);
$stmt->bindParam(':exhibit', $exhibit);

$stmt->execute();


// echo $colorBase;
// echo $exhibit;




// Retrieve data from the table and output it
$results = $db->query('SELECT * FROM bases');
while ($row = $results->fetchArray()) {
    echo $row['id'] . ': ' . $row['colorBase']. ', ' . $row['placed'] . ', (' . $row['exhibit'] . ')<br>';
}

// Close the database connection
$db->close();
?>

