<?php

// your config
$file = '../vendor/autoload.php';
if (file_exists($file)) {
    include_once $file;
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../')->load();
$filename = "minical.sql";

$dbHost = $_SERVER["DATABASE_HOST"];
$dbUser = $_SERVER["DATABASE_USER"];
$dbPass = $_SERVER["DATABASE_PASS"];
$dbName = $_SERVER["DATABASE_NAME"];



$mysqli_connection = mysqli_connect("$dbHost", "$dbUser", "$dbPass", "$dbName");
mysqli_select_db($mysqli_connection, $dbName) OR die('select db: ' . $dbName . ' failed: ' . mysqli_error($mysqli_connection));

($fp = fopen($filename, 'r')) OR die('failed to open file:' . $filename);

$sql = "DROP DATABASE $dbName";
if ($result = mysqli_query($mysqli_connection, $sql)) {
    echo '<script>alert("Reset Complete!");</script>';

    $sql1 = "CREATE DATABASE $dbName";
    mysqli_query($mysqli_connection, $sql1);

} else {
    echo mysqli_error($mysqli_connection);
}

