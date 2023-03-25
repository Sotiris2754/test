<?php
// Open a new SQLite database file or connect to an existing one
$db = new SQLite3('test.db');

// Create a table called "mytable" with 3 columns
$db->exec('CREATE TABLE mytable (id INTEGER PRIMARY KEY, name TEXT, email TEXT)');

// Insert data into the table
$db->exec("INSERT INTO mytable (name, email) VALUES ('John Doe', 'john@example.com')");
$db->exec("INSERT INTO mytable (name, email) VALUES ('Jane Doe', 'jane@example.com')");

// Retrieve data from the table and output it
$results = $db->query('SELECT * FROM mytable');
while ($row = $results->fetchArray()) {
    echo $row['id'] . ': ' . $row['name'] . ' (' . $row['email'] . ')<br>';
}

// Close the database connection
$db->close();
?>
