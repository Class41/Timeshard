<!DOCTYPE HTML>

<?php
session_start();

if(isset($_SESSION["type"]) && ($_SESSION["type"] == "employee" || $_SESSION["type"] == "hybrid"))
{

?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../styles/general.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <title>Timeshard - <?php echo $_SESSION["firstname"][0] . ". " . $_SESSION["lastname"][0];?></title>
    <script src="../../scripts/logout.js"></script>
    <script src="../../scripts/shardcontrol.js"></script>
    <script src="../../scripts/deps/progressbar.js"></script>
    <script src="../../scripts/populatetable.js"></script>
</head>

<body onload="GetShardStatus(); PullTabledata(0, document.getElementById('sessiontable'), true);">
    <div id="nav">
        <div class="navitem bgitemneutral" onclick="window.location.assign('./home.php');">
            <p class="navitemcontenttext">Home</p>
            <img class="navitemcontenticon" src="../../img/myshard.png" />
        </div>

        <?php if($_SESSION["type"] == "hybrid") {?>

        <div class="navitem bgitemgreen" onclick="window.location.assign('../shared/menu.php');">
            <p class="navitemcontenttext">Menu</p>
            <img class="navitemcontenticon" src="../../img/return.png" />
        </div>
        <?php }?>

        <div class="navitem bgitemred" onclick="Logout(); window.location.assign('../../index.php');">
            <p class="navitemcontenttext">Logout</p>
            <img class="navitemcontenticon" src="../../img/logoff.png" />
        </div>
    </div>

    <div>
        <div id="header">
            <img id="logo" src="../../img/logo.png" />
        </div>
    </div>
    <div id="pagecontent">

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">Task</h1>
        </div>
        <div class="container containerlarge">
            <div>
                <div class="subcontainer subgrid floatleft"> 
                    <h3>New Shard</h3>
                    <?php
                        require("../../scripts/dbconn.php");

                        if($sql = $db->prepare("SELECT value FROM timeshard_settings.employee_options WHERE `group`=?;"))
                        {
                            $sql->bind_param("s", $_SESSION["group"]);
                            $sql->execute();

                            $result = $sql->get_result();
                            mysqli_close( $db );
                        }
                    ?>        
                    <select id="taskselector">
                        <option selected disabled>Select Task</option>
                        <?php 
                            if($row = $result->fetch_assoc())
                            {
                                $optionarray = json_decode($row["value"], true);

                                for($i = 0; $i < sizeof($optionarray); $i++)
                                {
                                    echo "<option value=\"$optionarray[$i]\">" . $optionarray[$i] . "</option>";
                                }
                            }
                        ?>
                    </select>
                    
                    <input id="shardmemo" class="fullwidthinput" type="text" placeholder="memo (optional)" maxlength="100" oninput="UpdateCounter(this);" />
                    <sub id="inputcount">0/100</sub>
                </div>

                <div class="subcontainer subgrid">
                    <input id="shardbutton" class="button buttongreen buttonround" type="button" onclick="ToggleShard();" value="Begin"/>
                </div>
            </div>
        </div>

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">Session</h1>
        </div>
        <div class="container containerlarge">
            <div>
                <table id="sessiontable">
                    <tr>
                        <th>Action</th>
                        <th>Comment</th>
                        <th>Duration</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
}
else
{
    header("Location: ../../index.php");
}
?>