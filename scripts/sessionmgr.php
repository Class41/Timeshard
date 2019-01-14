<?php
session_set_save_handler('_open',
                         '_close',
                         '_read',
                         '_write',
                         '_destroy',
                         '_clean');
 
function _open()
{
    echo "open: called";
    require("./scripts/dbconn.php");
    echo "open: success";
    return true;
}
 
function _close()
{
    echo "close: called";
    global $db;
    echo "close: success";
    return mysqli_close( $db );
}

function _read($id)
{ 
    echo "read: called";
    global $db;

    $id = $db->real_escape_string($id);
 
    $sql = "SELECT `data`
            FROM `timeshard`.`sessions`
            WHERE `id`='$id'";

    if ($result = $db->query( $sql )) {
        if (mysqli_num_rows($result)) {
            $record = mysql_fetch_assoc($result);
            echo "read: success";
            $GLOBALS["dataexists"] = true;
            return $record['data'];
        }
    }

    echo "read: success/return nothing";
    $GLOBALS["dataexists"] = false;
    return false;
}

function _write($id, $data)
{
    echo "write: called";
    global $db;

    $id = $db->real_escape_string($id);
    $data = $db->real_escape_string($data);
 
    if(isset($GLOBALS["dataexists"]) && $GLOBALS["dataexists"] == true)
    {
        $sql = "UPDATE `timeshard`.`sessions` SET `data`='$data' WHERE `id`='$id'";
        echo "write: success/exists";
        return $db->query( $sql );
    }
    else if(isset($GLOBALS["dataexists"]) && $GLOBALS["dataexists"] == false)
    {
        $username = $_SESSION["username"];
        $timestamp = time();

        $sql = "INSERT INTO `timeshard`.`sessions`(`id`, `access`, `user`, `data`) VALUES ('$id', '$timestamp', '$username', '$data');";
        echo "write: success/created";
        return $db->query( $sql );
    }
    else
    {
        return false;
    }

}

function _destroy($id)
{ 
    echo "destroy: called";
    global $db;
    $id = $db->real_escape_string($id);
 
    $sql = "DELETE
            FROM `timeshard`.`sessions`
            WHERE `id`='$id'";
 
    echo "destroy: success";
    return $db->query( $sql );
}

function _clean($max)
{ 
    echo "clean: called";
    global $db;
    $old = time() - $max;
    $old = $db->real_escape_string($old);
 
    $sql = "DELETE
            FROM `timeshard`.`sessions`
            WHERE `access`<'$old'";

    echo "<br/><br/>clean: success";
    return $db->query( $sql );
}


session_start();

$_SESSION["test"] = 5;
?>