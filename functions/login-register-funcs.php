<?php

require_once '../config/loader.php';

if (isset($_POST['signup'])) {
    if (isset($_POST['name']) && isset($_POST['user_name']) 
    && isset($_POST['phone']) && isset($_POST['password'])
    && isset($_POST['confirm_password'])) {

        $name               = $_POST['name'];
        $username           = $_POST['user_name'];
        $phone              = $_POST['phone'];
        $pass               = $_POST['password'];
        $confirm_pass       = $_POST['confirm_password'];

        if(strlen($pass) < 8){
            header('Location: ../index.php?status=simplepassworderror');
            exit();
        }elseif($confirm_pass !== $pass){
            header('Location: ../index.php?status=notconfirmpassworderror');
            exit();
        }

        $is_name_ok     = preg_match('/^[آ-ی]+/', $name);
        $is_username_ok = preg_match('/^[a-zA-z_\d-]+$/', $username);
        $is_phone_ok    = preg_match('/^0[\d]{10}$/', $phone);

        if ($is_name_ok && $is_phone_ok && $is_username_ok) {
            try {
                $query   = "INSERT INTO users (`name`,username,phone,`password`) VALUES (?,?,?,?); ";
                $stmt   = $connection->prepare($query);
                $stmt->execute([$name, $username, $phone, $pass]);
                header('Location: ../index.php?status=successregister');
            } catch (PDOException $e) {
                die('Error : ' . $e->getMessage());
            }
        } else {
            header('Location: ../index.php?status=error');
        }
    } else {
        header('Location: ../index.php?status=error');
    }
} elseif (isset($_POST['signin'])) {

    if (isset($_POST['key']) && isset($_POST['password'])) {
        $key  = $_POST['key'];
        
        $pass = $_POST['password'];

        try {
            $query = "SELECT * FROM users WHERE(username=:key OR phone=:key) AND (`password`=:password) LIMIT 1";
            

            $stmp = $connection->prepare($query);
            $stmp->bindValue(":key", $key);
            $stmp->bindValue(":password", $pass);
            $stmp->execute();

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
    }else {
        header('Location: ../index.php?status=error');
    }
}
