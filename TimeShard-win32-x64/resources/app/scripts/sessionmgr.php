<?php
session_set_save_handler('_open',
                         '_close',
                         '_read',
                         '_write',
                         '_destroy',
                         '_clean');

function _open()
{
    require(realpath(dirname(__FILE__)."/dbconn.php"));
    return true;
}
 
function _close()
{
    global $db;
    return mysqli_close( $db );
}

function _read($id)
{ 
    global $db;

    $id = $db->real_escape_string($id);

    $sql = "SELECT `data`
            FROM `timeshard`.`sessions`
            WHERE `id`='$id'";

    if ($result = $db->query( $sql )) {
        if (mysqli_num_rows($result)) {
            $record = mysqli_fetch_assoc($result);
            $GLOBALS["dataexists"] = true;
            return $record['data'];
        }
    }

    $timestamp = time();

    $sql = "INSERT INTO `timeshard`.`sessions`(`id`, `access`, `user`, `data`) VALUES ('$id', '$timestamp', '', '');";

    $GLOBALS["dataexists"] = false;
    return '';
}

function _write($id, $data)
{
    require(realpath(dirname(__FILE__)."/dbconn.php"));
    global $db;

    $id = $db->real_escape_string($id);
    $data = $db->real_escape_string($data);
 
    if(isset($GLOBALS["dataexists"]) && $GLOBALS["dataexists"] == true)
    {
        $username = $_SESSION["username"];

        $sql = "UPDATE `timeshard`.`sessions` SET `data`='$data', `user`='$username' WHERE `id`='$id'";
        return $db->query( $sql );
    }
    else if(isset($GLOBALS["dataexists"]) && $GLOBALS["dataexists"] == false)
    {
        $timestamp = time();

        $sql = "INSERT INTO `timeshard`.`sessions`(`id`, `access`, `data`) VALUES ('$id', '$timestamp', '$data');";
        $GLOBALS["dataexists"] = true;
        return $db->query( $sql );
    }
    else
    {
        return false;
    }

}

function _destroy($id)
{ 
    global $db;
    $id = $db->real_escape_string($id);
 
    $sql = "DELETE
            FROM `timeshard`.`sessions`
            WHERE `id`='$id'";
 
    return $db->query( $sql );
}

function _clean($max)
{ 
    global $db;
    $old = time() - $max;
    $old = $db->real_escape_string($old);
 
    $sql = "DELETE
            FROM `timeshard`.`sessions`
            WHERE `access`<'$old'";

    return $db->query( $sql );
}

session_start();
?>