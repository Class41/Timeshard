<?php
require(realpath(dirname(__FILE__)."./sessionmgr.php"));

if ( isset( $_SESSION[ "type" ] ) && isset( $_POST[ "tabletype" ] ) )
{
    require( "./dbconn.php" );
    $username = $_SESSION[ "username" ];
    
    
    switch ( $_POST[ "tabletype" ] )
    {
        case 0:
            if ( isset( $_SESSION[ "sessionbeginindex" ] ) )
            {
                if ( $sql = $db->prepare( "SELECT `user_$username`.`action`, `user_$username`.`comment`, (SELECT timediff(time_end, time_start)) AS `timedelta` 
                FROM `timeshard_timetables`.`user_$username` 
                WHERE `id`<=? AND `id`>=? AND `flags`>=0 
                ORDER BY `user_$username`.`id` DESC LIMIT 10" ) )
                {
                    $sql->bind_param( "ss", $_SESSION[ "shardid" ], $_SESSION[ "sessionbeginindex" ] );
                    $sql->execute();
                    
                    $res = $sql->get_result();
                    
                    $i = 0;
                    $values = [];
                    
                    while ( $row = $res->fetch_assoc() )
                    {
                        $values[ $i ]                = $row;
                        $timevals                    = explode( ':', $row[ "timedelta" ] );
                        $values[ $i ][ "timedelta" ] = $timevals[ 0 ] . "h " . $timevals[ 1 ] . "m " . $timevals[ 2 ] . "s";
                        $i++;
                    }
                    echo json_encode( $values );
                }
            }
            break;
        case 1:
            if ( $sql = $db->prepare( "SELECT `user_$username`.`action`, `user_$username`.`comment`, (SELECT timediff(time_end, time_start)) AS `timedelta` 
            FROM `timeshard_timetables`.`user_$username` 
            WHERE `time_end`<=CURRENT_TIMESTAMP AND `flags`>=0 
            ORDER BY `user_$username`.`id` DESC LIMIT 10" ) )
            {
                $sql->execute();
                
                $res = $sql->get_result();
                
                $i = 0;
                $values = [];
                
                while ( $row = $res->fetch_assoc() )
                {
                    $values[ $i ]                = $row;
                    $timevals                    = explode( ':', $row[ "timedelta" ] );
                    $values[ $i ][ "timedelta" ] = $timevals[ 0 ] . "h " . $timevals[ 1 ] . "m " . $timevals[ 2 ] . "s";
                    $i++;
                }
                echo json_encode( $values );
            }
            break;
            case 2:
                if ( $sql = $db->prepare( "SELECT `user_$username`.`action`, `user_$username`.`comment`, (SELECT timediff(time_end, time_start)) AS `timedelta` 
                FROM `timeshard_timetables`.`user_$username` 
                WHERE `time_end`<=CURRENT_TIMESTAMP AND `flags`>=0 
                ORDER BY `user_$username`.`id` DESC LIMIT 10" ) )
                {
                    $sql->execute();
                    
                    $res = $sql->get_result();
                    
                    $i = 0;
                    $values = [];
                    
                    while ( $row = $res->fetch_assoc() )
                    {
                        $values[ $i ]                = $row;
                        $timevals                    = explode( ':', $row[ "timedelta" ] );
                        $values[ $i ][ "timedelta" ] = $timevals[ 0 ] . "h " . $timevals[ 1 ] . "m " . $timevals[ 2 ] . "s";
                        $i++;
                    }
                    echo json_encode( $values );
                }
                break;
    }
}

?>