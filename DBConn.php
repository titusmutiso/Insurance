<?php
//db host
$dbHost = 'localhost';
$dbName = 'sentAirtime';
//db credentials
$dbUser = 'imuserDB';
$dbPassword = 'killerPasswd';
//The table
$sendTable = 'sent';
//connect
$dbConnection = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
//log the errors
if ($dbConnection->connect_errno) 
{
error_log($dbConnection->connect_error,3,"./error.log");
 exit();
}
?>