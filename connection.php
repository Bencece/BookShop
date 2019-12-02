<?php
ini_set('mssql.charset', 'Hungarian_CI_AS');
$serverName = "BENCE-DELL\\SQLEXPRESSNEW"; //serverName\instanceName
$database = "bookshop";
$user = "";
$password = "1234Alma.";
$conn = odbc_connect("Driver={SQL Server};Server=$serverName;Database=$database;", $user, $password);
?>
