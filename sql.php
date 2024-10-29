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


if(ISSET($_POST['action']) && $_POST['action'] == "delete"){

$sql = "DELETE FROM `apps_collab_exh`";
$stmt = $conn->query($sql);
$stmt->close();
$conn->close();

}



if(ISSET($_POST['action'])&& $_POST['action']=="storebase"){
    $id = $_POST['id'];
    $base = $_POST['base'];
    // var_dump($id);
    // var_dump($base);
    // exit();


    $checkSql = "SELECT * FROM apps_collab_exh WHERE id = $id";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
            echo "A row with id $id already exists.";
        }
    else{
        $insertSql = "INSERT INTO apps_collab_exh SET id = $id";
        $conn->query($insertSql);
        // var_dump($insertSql);
    }

    // $sql = "UPDATE apps_collab_exh SET base = '".$base."' WHERE id = $id";
    $sql = "UPDATE apps_collab_exh SET base = $base WHERE id = $id";
    // var_dump($sql);
    $stmt = $conn->query($sql);
    $stmt->close();
    $conn->close();
}


if(ISSET($_POST['action'])&& $_POST['action']=="store"){

$id = $_POST['id'];
$exhibit = $_POST['exhibit'];

// Prepare the INSERT statement
$checkSql = "SELECT * FROM apps_collab_exh WHERE id = $id";
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
        echo "A row with id $id already exists.";
    }
else{
    $insertSql = "INSERT INTO apps_collab_exh (id) VALUES ($id)";
    $conn->query($insertSql);
}


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


// if(ISSET($_POST['action']) && $_POST['action']=="remove"){

// $conn->query("DELETE FROM apps_collab_exh WHERE id in (SELECT MAX(id) as id FROM apps_collab_exh ) ");
// $conn->query("ALTER TABLE apps_collab_exh AUTO_INCREMENT = 1 ");

// }

if(ISSET($_POST['action']) && $_POST['action'] == "retrieve"){
$data = array();
$sql = "SELECT * FROM apps_collab_exh";
$res = $conn->query($sql);

$resData = $res->fetch_all(MYSQLI_ASSOC);

foreach($resData as $row) {
    // code...
     // echo "ID: " . $row['id'] . ", Exhibit: " . $row['exhibit'] . "<br>";
    $data[] = $row;
}
$json = json_encode($data);
echo $json;

}


// if(ISSET($_POST['action']) && $_POST['action'] == "view"){
    
//     $data = array();
//     $sql = "SELECT exhibit FROM apps_collab_exh";
//     $res = $conn->query($sql);

//     $resData = $res->fetch_all(MYSQLI_ASSOC);



//     foreach ($resData as $key => $value) {
//         $data[]=$value['exhibit'];
//     }   

  
//     $json = json_encode($data);
//     echo $json;         
// }



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

