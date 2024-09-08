<?php

$servername     = "localhost";
$username       = "root";
$password       = "";
$database       = "login_register_otp";
$database_query = "CREATE DATABASE IF NOT EXISTS `login_register_otp` CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci";
$table_query    = "CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(15) NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
";


try {
  $connection = new PDO("mysql:host=$servername", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $connection->exec($database_query);
  $connection =null;
  $connection = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $connection->exec($table_query);
} 
catch (PDOException $e) {
  die('Connection ERROR : ' . $e->getMessage());
}



