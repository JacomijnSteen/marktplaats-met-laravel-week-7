<?php
// Create connection     
        $db = "marktplaats";
        $host = "localhost";
        $dsn = "mysql:dbname=$db;host=$host";
        $user_name = "root";
        $pass_word = "";  

        $connection = new PDO($dsn, $user_name, $pass_word);
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
        
       