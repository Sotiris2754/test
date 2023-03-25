<?php 

try{

    $db = new PDO('sqlite:game_PDO.sqlite');

    $db->exec("CREATE TABLE groups(id INTEGER PRIMARY KEY, name TEXT, email TEXT)");

    $db->exec("INSERT INTO groups(id,name, email) VALUES (1,'amy', 'amy@asdkasj.com');");
    $db->exec("INSERT INTO groups(id,name, email) VALUES (2,'Jim', 'jim@asdkasj.com');");
    $db->exec("INSERT INTO groups(id,name, email) VALUES (3,'Tom', 'tom@asdkasj.com');");

}
catch(PDOException $e{
    echo $e->getMessage();
}



?>