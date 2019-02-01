<?php
require(realpath(dirname(__FILE__)."./sessionmgr.php"));

if ( isset( $_POST[ "shard" ] ) && isset( $_SESSION[ "type" ] ) )
{
    if ( $shardval = json_decode( $_POST[ "shard" ] ) )
    {
        require( "./dbconn.php" );

        if ( $shardval->{'conntype'} == 0 )
        {
            if ( !$_SESSION[ "shardactive" ] )
            {
                $_SESSION[ "shardactive" ] = true;
                $_SESSION[ "shardtype" ]   = $shardval->{'shardtype'};
                
                $username = $_SESSION[ "username" ];
                if ( $sql = $db->prepare( "INSERT INTO `timeshard_timetables`.`user_$username` (`action`, `comment`, `time_start`, `time_end`, `flags`) 
                VALUES (?, '', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '-1');" ) )
                {
                    $sql->bind_param( "s", $shardval->{'shardtype'} );
                    $sql->execute();
                    
                    $_SESSION[ "shardid" ] = $db->insert_id;
                    
                    if ( !isset( $_SESSION[ "sessionbeginindex" ] ) )
                    {
                        $_SESSION[ "sessionbeginindex" ] = $_SESSION[ "shardid" ];
                    }
                    mysqli_close( $db );
                    echo "100";
                }
            }
            elseif ( $_SESSION[ "shardactive" ] )
            {
                mysqli_close( $db );
                echo "102";
            }
        }
        elseif ( $shardval->{'conntype'} == 1 )
        {
            if ( $_SESSION[ "shardactive" ] )
            {
                $_SESSION[ "shardactive" ] = false;
                
                $username = $_SESSION[ "username" ];
                
                
                if ( $sql = $db->prepare( "UPDATE `timeshard_timetables`.`user_$username` SET `time_end`=CURRENT_TIMESTAMP, `comment`=?, `flags`='0' WHERE `user_$username`.`id`=?;" ) )
                {
                    $sql->bind_param( "ss", $shardval->{'memoval'}, $_SESSION[ "shardid" ] );
                    $sql->execute();
                    mysqli_close( $db );
                }
                echo "101";
            }
            elseif ( !$_SESSION[ "shardactive" ] )
            {
                mysqli_close( $db );
                echo "103";
            }
        }
        elseif ( $shardval->{'conntype'} == 2 )
        {
            mysqli_close( $db );
            if ( $_SESSION[ "shardactive" ] == true )
            {
                echo "[\"102\", \"" . $_SESSION[ "shardtype" ] . "\"]";
            }
            else
            {
                echo "103";
            }
        }
    }
}

?>