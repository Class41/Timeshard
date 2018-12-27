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
    <script src="../../scripts/deps/progressbar.js"></script>
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
            <h1 class="textneutral">Summary</h1>
        </div>
        <div class="container containerlarge">
        
            <div class="subcontainer">
            
                <h1>Welcome Back, <?php echo $_SESSION["username"] ?></h1>
                <h4>(<?php echo $_SESSION["firstname"] ?>, <?php echo $_SESSION["firstname"] ?>)</h4>
            </div>

            <div class="subcontainer">
            <h2>Target Time</h2>
            <div id="empgraph" class="ignore"></div>
            <script src="../../scripts/animempgraph.js"></script>
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