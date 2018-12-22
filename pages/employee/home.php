<!DOCTYPE HTML>

<?php session_start(); if($_SESSION["type"] != "employee" && ($_SESSION["type"] != "hybrid") { header("Location: ../../index.php"); }?>