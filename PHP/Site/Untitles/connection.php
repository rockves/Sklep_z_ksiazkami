<?php
require_once('connectionConfig.php');
$connection = mysqli_connect($hostName, $user, $password, $databaseName);
if (!$connection) {
    die('Connection to database failed: ' . mysqli_connect_error());
}
?>