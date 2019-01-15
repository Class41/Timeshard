<?php
$server   = "localhost";
$user     = "root";
$password = "";

$GLOBALS["db"] = new mysqli( $server, $user, $password );
$db = $GLOBALS["db"];
if ( $GLOBALS["db"]->connect_error )
{
    die( "Connection failed: " . $GLOBALS["db"]->connect_error );
}

?>