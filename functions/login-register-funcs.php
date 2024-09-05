<?php

require_once '../config/loader.php';

if (isset($_POST['signup'])) {
    if (isset($_POST['name']) && isset($_POST['user_name']) && isset($_POST['phone']) && isset($_POST['password'])) {

        $name       = $_POST['name'];
        $username   = $_POST['user_name'];
        $phone      = $_POST['phone'];
        $pass       = $_POST['password'];


        $is_name_ok     = preg_match('/^[آ-ی]+$/', $name);
        $is_username_ok = preg_match('/^[a-zA-z_\d-]+$/', $username);
        $is_phone_ok    = preg_match('/^0[\d]{10}$/', $phone);


        try {
            //query
            $query   = "INSERT INTO users (`name`,username,phone,`password`) VALUES (?,?,?,?); ";
            //statment
            $stmt   = $connection->prepare($query);
            $stmt->execute([$name, $username, $phone, $pass]);
            //redirect
            header('Location: ../index.php');
        } catch (PDOException $e) {
            die('Error : ' . $e->getMessage());
        }
    }else{
        header('Location: ../index.php?status=error');
    }
} elseif (isset($_POST['key']) && isset($_POST['password'])) {
    $key  = $_POST['key'];
    $pass = $_POST['password'];

    try {
        //query
        $query = "SELECT * FROM users WHERE(username=:key OR phone=:key) AND (`password`=:password) LIMIT 1";

        //statment

        $stmp = $connection->prepare($query);
        $stmp->bindValue(":key", $key);
        $stmp->bindValue(":password", $pass);
        $stmp->execute();

        //resulat
        $result = $stmp->fetch(PDO::FETCH_ASSOC);
        $result_count = $stmp->rowCount();

        if ($result_count == 1) {
            header('Location: ../index.php?status=success');
        } else {
            header('Location: ../index.php?status=error');
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}