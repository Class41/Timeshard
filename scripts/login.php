<?php
    $server = "localhost";
    $user = "root";
    $password = "";

    $db = new mysqli($server, $user, $password);

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $sql = "CREATE DATABASE IF NOT EXISTS timeshard;";
    $db->query($sql);
    echo mysqli_error($db);

    $sql = "CREATE TABLE IF NOT EXISTS `timeshard`.`user` ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `firstname` VARCHAR(60) NOT NULL , 
        `lastname` VARCHAR(60) NOT NULL , 
        `email` VARCHAR(60) NOT NULL ,
        PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $db->query($sql);
    echo mysqli_error($db);

    $sql = "CREATE TABLE IF NOT EXISTS `timeshard`.`accounts` ( 
        `id` INT NOT NULL AUTO_INCREMENT , 
        `username` VARCHAR(30) NOT NULL , 
        `password` VARCHAR(512) NOT NULL , 
        `salt` VARCHAR(512) NOT NULL ,
        `type` VARCHAR(30) NOT NULL , 
        `userdata` int , 
        FOREIGN KEY (userdata) REFERENCES user(id),
        PRIMARY KEY (`id`)) ENGINE = InnoDB;";

    $db->query($sql);
    echo mysqli_error($db);

    if($sql = $db->prepare("SELECT * FROM timeshard.accounts WHERE username=?"))
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
            session_start();
            $_SESSION["username"] = $row["username"];
            $_SESSION["type"] = $row["type"];
            $_SESSION["id"] = $row["id"];
            
            if($sql = $db->prepare("SELECT * FROM timeshard.user 
                INNER JOIN timeshard.accounts ON 
                timeshard.user.id=(
                    SELECT userdata 
                    FROM timeshard.accounts 
                    WHERE timeshard.accounts.id=?
                    )"))
            {
                $sql->bind_param("s", $row['id']);
                $sql->execute();
            }

            $result = $sql->get_result();
            $row = $result->fetch_assoc(); 

            $_SESSION["firstname"] = $row["firstname"];
            $_SESSION["lastname"] = $row["lastname"];
            $_SESSION["email"] = $row["email"];

            header("Location: ./pages/shared/menu.php");
        }
        else
        {
            $GLOBALS["valid"] = false;
        }
    }
    else
    {
        $GLOBALS["valid"] = false;
    }
?>