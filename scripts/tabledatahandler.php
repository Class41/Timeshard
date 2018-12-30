<?php
session_start();

if(isset($_SESSION["type"]) && isset($_POST["tabletype"]))
{
    require("./dbconn.php");
    $username = $_SESSION["username"];

    
    switch($_POST["tabletype"])
    {
        case 0:
            if(isset($_SESSION["sessionbeginindex"])) 
            {
                if($sql = $db->prepare("SELECT `user_$username`.`action`, `user_$username`.`comment`, (SELECT timediff(time_end, time_start)) AS `timedelta` FROM `timeshard_timetables`.`user_$username` WHERE `id`>=? AND `id`<=? LIMIT 10"))
                {
                            $sql->bind_param("ss", $_SESSION["sessionbeginindex"], $_SESSION["shardid"]);
                            $sql->execute();

                            $res = $sql->get_result();

                            $i = 0;
                            $values = [];

                            while($row = $res->fetch_assoc())
                            {
                                $values[$i] = $row;
                                $timevals = explode(':', $row["timedelta"]);
                                $values[$i]["timedelta"] = $timevals[0] . "h " . $timevals[1] . "m " . $timevals[2] . "s";
                                $i++;
                            }
                            echo json_encode($values);
                }
            }
            break;
    }
}

?>
