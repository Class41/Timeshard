<!DOCTYPE HTML>

<?php
session_start();

if($_SESSION["type"] != "employee" && $_SESSION["type"] != "hybrid")
{
    header("Location: ../../index.php");
}
?>

<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../styles/general.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <title>Timeshard - <?php echo $_SESSION["firstname"][0] . ". " . $_SESSION["lastname"][0];?></title>
    <script src="../../scripts/logout.js"></script>
</head>

<body>
    <div id="nav">
        <div class="navitem bgitemred" onclick="Logout(); window.location.assign('../../index.php');">
            <p class="navitemcontenttext">Logout</p>
            <img class="navitemcontenticon" src="../../img/logoff.svg" />
        </div>
        <?php if($_SESSION["type"] == "hybrid") {?>

        <div class="navitem bgitemgreen" onclick="window.location.assign('../shared/menu.php');">
            <p class="navitemcontenttext">Menu</p>
            <img class="navitemcontenticon" src="../../img/return.svg" />
        </div>
        <?php }?>
    </div>

    <div>
        <div id="header">
            <img id="logo" src="../../img/logo.png" />
        </div>
    </div>
    <div id="pagecontent">

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">Tasks</h1>
        </div>
        <div class="container containerlarge">
            <div class="selectioncontainer ignore">
                <select>
                    <option DISABLED SELECTED></option>
                    <option>test</option>
                </select>

                <input class="button buttongreen selectionbutton" type="button" value="Modify"/>
            </div>
        </div>

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">Recent</h1>
        </div>
        <div class="container containerlarge">

        </div>

        <div class="flag flaggreen containerheaderflag flaglarge">
            <h1 class="textneutral">History</h1>
        </div>

        <div class="container containerlarge">

        </div>
    </div>
</body>
</html>