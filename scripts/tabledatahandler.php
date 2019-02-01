<?php
require(realpath(dirname(__FILE__)."/sessionmgr.php"));

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
                if ( $sql = $db->prepare( "SELECT (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(`time_end`, `time_start`)))) FROM `timeshard_timetables`.`user_$username` WHERE `time_start` > DATE_ADD(NOW(), INTERVAL -1 DAY)) AS 24h,
                                          (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(`time_end`, `time_start`)))) FROM `timeshard_timetables`.`user_$username` WHERE `time_start` > DATE_ADD(NOW(), INTERVAL -7 DAY)) AS 7d,
                                          (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(`time_end`, `time_start`)))) FROM `timeshard_timetables`.`user_$username` WHERE `time_start` > DATE_ADD(NOW(), INTERVAL -30 DAY)) AS 30d,
                                          (SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(timediff(`time_end`, `time_start`)))) FROM `timeshard_timetables`.`user_$username` WHERE `time_start` > DATE_ADD(NOW(), INTERVAL -90 DAY)) AS 90d " ) )
                {
                    $sql->execute();
                    
                    $res = $sql->get_result();
                    
                    $i = 0;
                    $values = [];
                    $periods = ["24 Hours", "7 days", "30 Days", "90 Days"];
                    $pnames = ["24h", "7d", "30d", "90d"];

                    if( $row = $res->fetch_assoc() )
                    {
                        for($i = 0; $i <= 3; $i++)
                        {
                            $values[ $i ][0] = $periods[$i];
                            $values[ $i ][1] = "yes";
                            $timevals                    = explode( ':', $row[ $pnames[ $i ] ] );
                            $values[ $i ][ 2 ] = $timevals[ 0 ] . "h " . $timevals[ 1 ] . "m " . $timevals[ 2 ] . "s";
                        }
                    }

                    echo json_encode( $values );
                }
                break;
    }
}

?>