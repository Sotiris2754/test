<?php
// Open a new SQLite database file
$db = new SQLite3('test.db');
    
// Execute a SELECT query on the table
$results = $db->query('SELECT * FROM mytable');

// $results ->>>> remove all data 
// Create an array to hold the results
$data = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $data[] = $row;
}

// Convert the results to JSON and output it
header('Content-Type: application/json');
echo json_encode($data);


// public function construct_Database(){
//     query('CREATE TABLE vaseis_paixnidiou');
//     run->query;
//} 
// Close the database connection

$db->close();
?>
