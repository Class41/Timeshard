<?php 
session_start();

if(isset($_POST["shard"]) && isset($_SESSION["type"]))
{
    if($shardval = json_decode($_POST["shard"]))
    {
        $server = "localhost";
        $user = "root";
        $password = "";
    
        $db = new mysqli($server, $user, $password);

        if ($db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }

        if($shardval->{'conntype'} == 0)
        {      
            if(!$_SESSION["shardactive"])
            {
                $_SESSION["shardactive"] = true;
                $_SESSION["shardtype"] = $shardval->{'shardtype'};

                $username = $_SESSION["username"];
                if($sql = $db->prepare("INSERT INTO `timeshard_timetables`.`user_$username` (`action`, `comment`, `time_start`, `time_end`, `flags`) 
                VALUES (?, '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '-1');"))
                {
                    $sql->bind_param("s", $shardval->{'shardtype'});
                    $sql->execute();

                    $_SESSION["shardid"] = $db->insert_id;

                    if(!isset($_SESSION["sessionbeginindex"]))
                    {
                        $_SESSION["sessionbeginindex"] = $_SESSION["shardid"];
                    }

                    echo "100";
                }    
            } 
            elseif($_SESSION["shardactive"])
            {
                echo "102";
            }
        }
        elseif($shardval->{'conntype'} == 1)
        {
            if($_SESSION["shardactive"])
            {
                $_SESSION["shardactive"] = false;

                $username = $_SESSION["username"];


                if($sql = $db->prepare("UPDATE `timeshard_timetables`.`user_$username` SET `time_end`=CURRENT_TIMESTAMP, `comment`=?, `flags`='0' WHERE `user_$username`.`id`=?;"))
                {
                    $sql->bind_param("ss", $shardval->{'memoval'} ,$_SESSION["shardid"]);
                    $sql->execute();
                }
                echo "101";    
            } 
            elseif(!$_SESSION["shardactive"])
            {
                echo "103";
            }
        }
        elseif($shardval->{'conntype'} == 2)
        {
            if ($_SESSION["shardactive"] == true)
            {
                echo "[\"102\", \"" . $_SESSION["shardtype"] . "\"]";
            }
            else
            {
                echo "103";
            }
        }
    }
} 

?>