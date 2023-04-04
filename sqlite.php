<?php

// Open a new SQLite database file or connect to an existing one
$db = new SQLite3('test.db');


//Check if bases table exists
$tableExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='bases'");


// Create a table called "bases" with 3 columns
if(!$tableExists){
$db->exec('CREATE TABLE bases (id INTEGER PRIMARY KEY, colorBase TEXT, exhibit NUMBER)');


//Insert data into the table
$db->exec("INSERT INTO bases (colorBase) VALUES ('Yellow')");
$db->exec("INSERT INTO bases (colorBase) VALUES ('Red')");
$db->exec("INSERT INTO bases (colorBase) VALUES ('Green')");
$db->exec("INSERT INTO bases (colorBase) VALUES ('Blue')");
$db->exec("INSERT INTO bases (exhibit) VALUES (null)");
$db->exec("INSERT INTO bases (exhibit) VALUES (null)");
$db->exec("INSERT INTO bases (exhibit) VALUES (null)");
$db->exec("INSERT INTO bases (exhibit) VALUES (null)");

 }


if(ISSET($_POST['action'])&& $_POST['action']=="store"){


$id = $_POST['id'];
$exhibit = $_POST['exhibit'];

$stmt = $db->prepare("UPDATE bases SET exhibit = :exhibit WHERE id = $id");
$stmt->bindParam(':exhibit', $exhibit);
$stmt->execute();



}

if(ISSET($_POST['action']) && $_POST['action'] == "view"){
        
    $data = array();
    $sql = "SELECT exhibit FROM bases";
    $stmt = $db->prepare($sql);
    $result = $stmt->execute();
    while ($row = $result->fetchArray(SQLITE3_ASSOC)){
        //echo $row['exhibit'] . "<br>";
        $data[] = $row['exhibit'];
    }

  
    $json = json_encode($data);
    //var_dump($json);
    echo $json; 
   }





//Εμφάνιση του database
// $results = $db->query('SELECT * FROM bases');
// while ($row = $results->fetchArray()) {
//     echo $row['id'] . ': ' . $row['colorBase'] . ', Έκθεμα:(' . $row['exhibit'] . ') ';
// }

//ΔΕΝ ΞΕΡΩ ΑΝ ΧΡΕΙΑΖΕΤΑΙ ΑΥΤΟ.
$db->close();


//ΠΡΟΗΓΟΥΜΕΝΗ ΜΟΡΦΗ ΚΩΔΙΚΑ ΓΙΑ ΕΙΣΑΓΩΓΗ ROW ΣΤΗΝ ΒΑΣΗ ΔΕΔΟΜΕΝΩΝ

//  if(ISSET($_POST['action'])&& $_POST['action']=="store"){

// $colorBase = $_POST['colorBase'];
// $exhibit = $_POST['exhibit'];

// $stmt = $db->prepare("INSERT INTO bases (colorBase, exhibit) VALUES (:colorBase, :exhibit)");
// $stmt->bindParam(':colorBase', $colorBase);
// $stmt->bindParam(':exhibit', $exhibit);
// $stmt->execute();
// echo $colorBase;
// echo $exhibit;
// }
?>

