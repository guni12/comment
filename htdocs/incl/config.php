<?php
include("../../vendor/autoload.php");

error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors

$di = new \Anax\DI\DIFactoryConfig(__DIR__ . "/di.php");
