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
        $server = "localhost";
        $user = "root";
        $password = "";
        
        $db = new mysqli($server, $user, $password);

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