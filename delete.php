<?php
require_once("class/db.php");
session_start();
if (isset($_SESSION["mail"]) && $_GET["id"])
{
    $id = $_GET["id"];
    $test = new sqlRequest();
    $result = $test->get("DELETE FROM students WHERE id = $id");
    header("location: home.php");
}
else
{
    header("location: login.php");
}