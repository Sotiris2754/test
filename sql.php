<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "v-corfu";


$conn = new mysqli($servername,$username,$password,$database);


// Check if bases table exists

// $tableExists = $db->querySingle("SELECT name FROM sqlite_master WHERE type='table' AND name='bases'");

// Create a table called "bases" with 3 columns
// if(!$tableExists2){
// $db->exec('CREATE TABLE apps_collab_exh (id INTEGER PRIMARY KEY, exhibit NUMBER)');
// $db->exec("INSERT INTO bases (exhibit) VALUES (null)");
// $db->exec("INSERT INTO bases (exhibit) VALUES (null)");
// $db->exec("INSERT INTO bases (exhibit) VALUES (null)");
// $db->exec("INSERT INTO bases (exhibit) VALUES (null)");
// }

if(ISSET($_POST['action'])&& $_POST['action']=="store"){

$id = $_POST['id'];
$exhibit = $_POST['exhibit'];



// Prepare the INSERT statement

$sql = "UPDATE apps_collab_exh SET exhibit = $exhibit WHERE id = $id";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind the parameter and set its value
    // $stmt->bind_param("i", $exhibitValue);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Error: " . $conn->error;
}

// Close the database connection
$conn->close();

}

if(ISSET($_POST['action']) && $_POST['action']=="add"){

    $query = "INSERT INTO apps_collab_exh (exhibit) VALUES (null)";
    $conn->query($query);
}

if(ISSET($_POST['action']) && $_POST['action']=="remove"){

// $db->exec("DELETE FROM bases WHERE MAX(id)");


// Execute the query and get the ID of the last row
// $result = $db->querySingle($query);

// if (!$result) {
//     // Handle the case where the table is empty
//     die("Table is empty");
// }
$conn->query("DELETE FROM apps_collab_exh WHERE id in (SELECT MAX(id) as id FROM apps_collab_exh ) ");
$conn->query("ALTER TABLE apps_collab_exh AUTO_INCREMENT = 1 ");
// $
// Define the SQL query to delete the last row from the table
// $query = "DELETE FROM apps_collab_exh WHERE id = $result";

// Execute the query
// $db->exec($query);

}

if(ISSET($_POST['action']) && $_POST['action'] == "view"){
        
    $data = array();
    $sql = "SELECT exhibit FROM apps_collab_exh";
    // $stmt = $conn->prepare($sql);
    // $stmt = $stmt->execute();
    
    // $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // while ($row = $result->fetchArray(SQLITE3_ASSOC)){
    //     //echo $row['exhibit'] . "<br>";
    //     $data[] = $row['exhibit'];
    // }
$res = $conn->query($sql);

$resData = $res->fetch_all(MYSQLI_ASSOC);

    // $result = mysqli_query($conn,$sql);
    // while($row  = mysqli_fetch_array($result))
    //     $data[]= $row['exhibit'];

foreach ($resData as $key => $value) {
    $data[]=$value['exhibit'];
}

  
    $json = json_encode($data);
    echo $json; 
}

// if(ISSET($_POST['action']) && $_POST['action'] == 'count'){
//     $result = $db->query('SELECT COUNT(*) AS numInserts FROM bases');
//     $row = $result->fetchArray(SQLITE3_ASSOC);
//     $inserts = $row['numInserts'];

//     echo $inserts;
// }





//Εμφάνιση του database
// $results = $db->query('SELECT * FROM bases');
// while ($row = $results->fetchArray()) {
//     echo $row['id'] . ': ' . $row['base'] . ', Έκθεμα:(' . $row['exhibit'] . ') ';
// }

//ΔΕΝ ΞΕΡΩ ΑΝ ΧΡΕΙΑΖΕΤΑΙ ΑΥΤΟ.


//ΠΡΟΗΓΟΥΜΕΝΗ ΜΟΡΦΗ ΚΩΔΙΚΑ ΓΙΑ ΕΙΣΑΓΩΓΗ ROW ΣΤΗΝ ΒΑΣΗ ΔΕΔΟΜΕΝΩΝ

//  if(ISSET($_POST['action'])&& $_POST['action']=="store"){

// $colorBase = $_POST['colorBase'];
// $exhibit = $_POST['exhibit'];

// $stmt = $db->prepare("INSERT INTO bases (base, exhibit) VALUES (:colorBase, :exhibit)");
// $stmt->bindParam(':colorBase', $colorBase);
// $stmt->bindParam(':exhibit', $exhibit);
// $stmt->execute();
// echo $colorBase;
// echo $exhibit;
// }
?>

