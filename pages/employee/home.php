<!DOCTYPE HTML>

<?php
require("../../scripts/sessionmgr.php");

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
    <script src="../../scripts/deps/progressbar.js"></script>
    <script src="../../scripts/populatetable.js"></script>
</head>

<body onload="PullTabledata(1, document.getElementById('tableuserrecent'), true); PullTabledata(2, document.getElementById('tableuserhistory'), true);">
    <div id="nav">
        <div class="navitem bgitemneutral" onclick="window.location.assign('./timeshard.php');">
            <p class="navitemcontenttext">Shard</p>
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
            <h1 class="textneutral">Summary</h1>
        </div>
        <div class="container containerlarge">
            <div>
                <div class="subcontainer">         
                    <h1 class="limitdot textgreen">Welcome Back</h1>
                    <h4 class="limitdot"><?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"] ?></h4>
                </div>

                <div class="subcontainer">
                    <h2>Current Goal</h2>
                    <div id="empgraph" class="ignore"></div>
                    <script src="../../scripts/animempgraph.js"></script>
                </div>
            </div>
        </div>

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">Recent</h1>
        </div>
        <div class="container containerlarge">
            <div>
                    <table id="tableuserrecent">
                        <tr>
                            <th>Action</th>
                            <th>Comment</th>
                            <th>Duration</th>
                        </tr>
                    </table>
                </div>
        </div>

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">History</h1>
        </div>
        <div class="container containerlarge">
                <div>
                    <table id="tableuserhistory">
                        <tr>
                            <th>Time Period</th>
                            <th>Target Met</th>
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