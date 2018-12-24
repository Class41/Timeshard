<!DOCTYPE HTML>

<?php 
session_start();

if($_SESSION["type"] != "employer" && $_SESSION["type"] != "hybrid") 
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
    </head>

    <body>
        <div>
            <div id="header">
                <img id="logo" src="../../img/logo.png" />
            </div>
        </div>
        <div id="pagecontent">
            <div class="flag flaggreen containerheaderflag flaglarge"> 
                <h1 class="textneutral">Select</h1>
            </div>
            <div class="container containerlarge">
                <h3 class="limitdot">Logged In: <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];?></h3>               
            </div>
        </div>
        </div>
        <div>

        </div>
    </body>
</html>