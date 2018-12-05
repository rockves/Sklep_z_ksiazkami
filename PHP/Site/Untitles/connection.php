<?php
require_once('connectionConfig.php');
$connection = new mysqli($hostName, $user, $password, $databaseName);
if ($connection->connect_error) {
    die('Connection to database failed: ' . $connection->connect_error);
}
$connection->set_charset("utf8");

	function prepareFormData($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
?>