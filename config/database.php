<?php

 $servername = "localhost";
 $username   = "root";
 $password   = "";
 $dbname     = "login_register_otp";

try {
  $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die('Connection ERROR : ' . $e->getMessage());
}

