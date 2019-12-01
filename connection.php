<?php
header('charset=utf-8');
$serverName = "BENCE-DELL\\SQLEXPRESSNEW"; //serverName\instanceName
$database = "master";
$user = "";
$password = "1234Alma.";
$conn = odbc_connect("Driver={SQL Server};Server=$serverName;Database=$database;", $user, $password);
?>
