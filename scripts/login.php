<?php
    $server = "localhost";
    $user = "root";
    $password = "";

    $db = new mysqli($server, $user, $password);

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS timeshard;
    
    CREATE TABLE IF NOT EXISTS timeshard.accounts(\n"

    . "    `id` INT NOT NULL AUTO_INCREMENT,\n"

    . "    `username` VARCHAR(30) NOT NULL,\n"

    . "    `password` VARCHAR(512) NOT NULL,\n"

    . "    `salt` VARCHAR(512) NOT NULL,\n"

    . "    PRIMARY KEY(`id`)\n"

    . ") ENGINE = InnoDB";

    $db->query($sql);


    if($sql = $db->prepare("SELECT * FROM timeshard.accounts WHERE username=?"));
    {
        $sql->bind_param("s", $_POST["username"]);
        $sql->execute();
    }


    $result = $sql->get_result();

    if($result->num_rows == 1)
    {
        $row = $result->fetch_assoc();   
         
        if(hash('sha512', $row["salt"] . $_POST["password"] . $_POST["password"] . $row["salt"]) == $row["password"])
        {
            echo "<p style=\"color: green;\">Valid credentials.</p>";
        }
    }
    else
    {
        echo "<p style=\"color: red;\">Invalid credentials. </p>";
    }
?>