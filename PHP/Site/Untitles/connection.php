<?php
require_once('connectionConfig.php');
$connection = new mysqli($hostName, $user, $password, $databaseName);
if ($connection->connect_error) {
    die('Connection to database failed: ' . $connection->connect_error);
}
?>