<?php
session_set_save_handler('_open',
                         '_close',
                         '_read',
                         '_write',
                         '_destroy',
                         '_clean');
 
function _open()
{
    require("./dbconn.php");
    $db->select_db("timeshard.sessions");
}
 
function _close()
{
    mysqli_close( $db );
}

session_start();
?>