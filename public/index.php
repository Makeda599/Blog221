<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
// define("ROOT", (str_replace("public","",$_SERVER['DOCUMENT_ROOT'])));
define("ROOT", dirname(__DIR__) . "/");


$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/') . '/';
define("WEBROOT", $protocol . $_SERVER['HTTP_HOST'] . $basePath);
// define("WEBROOT","http://localhost:8005/");

require_once(ROOT."db/config.php");
require_once(ROOT."db/helpers.php");
require_once(ROOT."validation/validation.php");
require_once(ROOT."route/web/route.php");

gestionController();
