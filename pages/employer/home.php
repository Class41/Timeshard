<!DOCTYPE HTML>

<?php session_start(); if($_SESSION["type"] != "employer" && ($_SESSION["type"] != "hybrid") { header("Location: ../../index.php"); }?>