<?php
require_once('connectionConfig.php');
$connection = mysqli_connect($hostName, $user, $password, $databaseName);
if ($connection->connect_error) {
    die("Connection to database failed: " . $conn->connect_error);
}
?>