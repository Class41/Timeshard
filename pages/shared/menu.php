<!DOCTYPE HTML>

<?php 
    session_start();

    if($_SESSION["type"] == "employee")
    {
        header("Location: ../employee/home.php");
    } 
    elseif($_SESSION["type"] == "employer")
    {
        header("Location: ../employer/home.php");
    }
    elseif($_SESSION["type"] == "hybrid")
    { 
 ?>

<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../styles/general.css" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
    <title>Timeshard - <?php echo $_SESSION["firstname"][0] . ". " . $_SESSION["lastname"][0];?></title>
    <script src="../../scripts/logout.js"></script>
</head>

<body>
    <div>
        <div id="header">
            <img id="logo" src="../../img/logo.png" />
        </div>
    </div>
    <div id="pagecontent">
        <div class="flag flaggreen containerheaderflag"> 
            <h1 class="textneutral">Select</h1>
        </div>
        <div class="container">
            <h3 class="limitdot">Logged In: <?php echo $_SESSION["firstname"] . " " . $_SESSION["lastname"];?></h3>               
            <input class="button buttongreen selectionbutton" type="button" value="Employer" onclick="window.location.assign('../employer/home.php');"> <br />
            <input class="button buttongreen selectionbutton" type="button" value="Employee" onclick="window.location.assign('../employee/home.php');"> <br />
            <form method="POST">
                <input class="button buttongreen selectionbutton logbutton" type="submit" value="Logout" onclick="Logout(); window.location.assign('../../index.php');"> <br />
            </form>
        </div>
    </div>
    </div>
    <div>

    </div>
</body>

    <?php 
        }
        else
        {
            session_unset();
            header("Location: ../../index.php");
        }
    ?>
</html>