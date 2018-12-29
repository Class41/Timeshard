<?php 

if(isset($_POST["shard"]))
{
    if($shardval = json_decode($_POST["shard"]))
    {
        session_start();

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

                $username = $_SESSION["username"];
                if($sql = $db->prepare("INSERT INTO `timeshard_timetables`.`user_$username` (`action`, `comment`, `time_start`, `time_end`, `flags`) 
                VALUES (?, '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '-1');"))
                {
                    $sql->bind_param("s", $shardval->{'shardtype'});
                    $sql->execute();

                    $_SESSION["shardid"] = $db->insert_id;
                }    
            } 
            elseif($_SESSION["shardactive"])
            {
                echo false;
            }
        }
        elseif($shardval->{'conntype'} == 1)
        {
            if($_SESSION["shardactive"])
            {
                $_SESSION["shardactive"] = false;

                $username = $_SESSION["username"];


                if($sql = $db->prepare("UPDATE `timeshard_timetables`.`user_$username` SET `time_end`=CURRENT_TIMESTAMP, `comment`=? WHERE `user_$username`.`id`=?;"))
                {
                    $sql->bind_param("ss", $shardval->{'memoval'} ,$_SESSION["shardid"]);
                    $sql->execute();
                }    
            } 
            elseif(!$_SESSION["shardactive"])
            {
                echo false;
            }
        }
        elseif($shardval->{'conntype'} == 2)
        {
            echo $_SESSION["shardactive"];
        }
    }
} 

?>