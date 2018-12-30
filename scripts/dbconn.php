<?php 
        $server = "localhost";
        $user = "root";
        $password = "";
    
        $db = new mysqli($server, $user, $password);
    
        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
?>