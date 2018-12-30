<?php 

    ValidateRegistration();

    function ValidateRegistration()
    {
        GenerateSalt();
        PassCrypt();
        SetEmpType();
        InsertRegistration();
    }

    function SetEmpType()
    {
        $GLOBALS["emptype"] = "hybrid";
    }

    function GenerateSalt()
    {
        $GLOBALS["salt"] = random_bytes(128);
    }

    function PassCrypt()
    {
        $_POST["password"] = password_hash($_POST["password"] . $GLOBALS["salt"] . $_POST["password"], PASSWORD_ARGON2I);
    }

    function InsertRegistration()
    {
        require("../../scripts/dbconn.php");

        $sql = "CREATE DATABASE IF NOT EXISTS timeshard;";
        $db->query($sql);
    
        $sql = "CREATE DATABASE IF NOT EXISTS timeshard_timetables;";
        $db->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS `timeshard`.`user` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `firstname` VARCHAR(60) NOT NULL , 
            `lastname` VARCHAR(60) NOT NULL , 
            `email` VARCHAR(60) NOT NULL ,
            PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1 COLLATE latin1_general_cs;";
    
        $db->query($sql);
    
        $sql = "CREATE TABLE IF NOT EXISTS `timeshard`.`accounts` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `username` VARCHAR(30) NOT NULL , 
            `password` VARCHAR(96) NOT NULL , 
            `salt` VARCHAR(128) NOT NULL ,
            `type` VARCHAR(30) NOT NULL , 
            `group` VARCHAR(30) NOT NULL DEFAULT 'none', 
            `userdata` int , 
            FOREIGN KEY (userdata) REFERENCES user(id),
            PRIMARY KEY (`id`)) ENGINE = InnoDB DEFAULT CHARSET=latin1 COLLATE latin1_general_cs;";
        $db->query($sql);

        $username = $_POST["username"];
        $sql = "CREATE TABLE IF NOT EXISTS `timeshard_timetables`.`user_$username` ( 
            `id` INT NOT NULL AUTO_INCREMENT , 
            `action` VARCHAR(255) NOT NULL , 
            `comment` TEXT NOT NULL , 
            `time_start` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ,
            `time_end` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            `flags` INT(4) NOT NULL , 
             PRIMARY KEY (`id`)) ENGINE = InnoDB;";

        $db->query($sql);

        if($sql = $db->prepare("INSERT INTO timeshard.user(`firstname`, `lastname`, `email`) VALUES (?, ?, ?)"))
        {
            $sql->bind_param("sss", $_POST["firstName"], $_POST["lastName"], $_POST["email"]);
            $sql->execute();

            if($sql = $db->prepare("INSERT INTO timeshard.accounts(`username`, `password`, `salt`, `type`, `userdata`) VALUES (?, ?, ?, ?, LAST_INSERT_ID())"))
            {
                $sql->bind_param("ssss", $_POST["username"], $_POST["password"], $GLOBALS["salt"], $GLOBALS["emptype"]);
                $sql->execute();
            }
        }

        echo mysqli_error($db);
        mysqli_close($db);
    }

?>