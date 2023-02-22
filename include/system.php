<?php
session_start();

include_once "config.php";
include_once "functions.php";
include_once "database.php";

include_once "backend/authentication.php";

include_once "controller.php";

$controller = new controller();
$db         = new db();
$auth       = new auth();
