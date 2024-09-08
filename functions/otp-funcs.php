<?php

require_once '../config/loader.php';

if (isset($_POST['forget-password'])) {

    if (isset($_POST['phonenumber'])) {
        $is_phone_ok = preg_match('/^0[\d]{10}$/', $_POST['phonenumber']);

        if ($is_phone_ok) {
            $phone = $_POST['phonenumber'];
            //query
            $query = "SELECT * FROM users WHERE(phone=:key) LIMIT 1";

            //statment
            $stmp = $connection->prepare($query);
            $stmp->bindValue(":key", $phone);
            $stmp->execute();

            //resulat
            $result = $stmp->fetch(PDO::FETCH_ASSOC);
            $result_count = $stmp->rowCount();

            echo $result_count;
            if ($result_count === 1) {

                $random = sendRegisterCode($phone);
                $query = "UPDATE users SET code = :code WHERE phone = :phone";
                $stmp = $connection->prepare($query);
                $stmp->bindParam(":code", $random);
                $stmp->bindParam(":phone", $phone);
                $stmp->execute();

                header('Location: ../otp.php?status=successinputnumber&phone=' . $phone);
            } else {
                header('Location: ../otp.php?status=errorinputnumber');
            }
        } else {
            header('Location: ../otp.php?status=errornotinum');
        }
    } else {
        header('Location: ../otp.php?status=errornotinum');
    }
} elseif (isset($_POST['send-random'])) {
    $phone  = $_POST['phone'];

    if (isset($_POST['random-number'])) {
        $is_random_ok = preg_match('/^[\d]{4}$/', $_POST['random-number']);
        if ($is_random_ok) {

            $code  = $_POST['random-number'];

            $query = "SELECT code FROM users WHERE phone = :phone";
            $stmp = $connection->prepare($query);
            $stmp->bindValue(":phone", $phone);
            $stmp->execute();

            $result = $stmp->fetch(PDO::FETCH_ASSOC);

            if($result['code'] == $code){
                header('Location:../index.php?status=successinotpsignin');
            }else{
                header('Location:../otp.php?status=errorinotpsignin&phone=' . $phone);
            }
        }
    }
}

function sendRegisterCode($phone)
{

    $randomN  = rand(1000, 9999);
    //در صورت ارسال دیتا تایپ عددی سامانه ملی پیامک خطا می دهد و قبول نمیکند. به همین دلیل در به قالب رشته تبدیل می کنیم
    $random  = strval($randomN);
    $query = "insert into users code values ? where phone=?";
    include 'otp-account.php';

    /*  $data = array('bodyId' => 242394, 'to' => $phone, 'args' => [$random]);
    $data_string = json_encode($data);


    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt(
        $ch,
        CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        )
    );
    $result = curl_exec($ch);
    curl_close($ch);
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    } */
    return $random;
}
