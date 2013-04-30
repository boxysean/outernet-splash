<?php
session_start();

switch ($_GET["v"]) {
case "register":
    include_once "templates/register.php";
    break;

case "new-user":
    include_once "templates/new-user.php";
    break;

case "front":
default:
    include_once "templates/front.php";
    break;
}

?>
