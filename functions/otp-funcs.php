<?php

require_once '../config/loader.php';


if (isset($_POST['phonenumber'])) {


    $phone = $_POST['phonenumber'];

    //query
    $query = "SELECT * FROM users WHERE(email=:key OR phone=:key) LIMIT 1";

    //statment
    $stmp = $conn->prepare($query);
    $stmp->bindValue(":key", $phone);
    $stmp->execute();

    //resulat
    $result = $stmp->fetch(PDO::FETCH_ASSOC);

    $result_count = $stmp->rowCount();
    var_dump($result_count);
    echo $result_count;
    if ($result_count === 1) {
        header('Location: ../otp.php?status=successinputnumber');
    } else {
        header('Location: ../otp.php?status=errorinputnumber');
    }

/* 
    $randomN  = rand(1000, 9999);

    //در صورت ارسال دیتا تایپ عددی سامانه ملی پیامک خطا می دهد و قبول نمیکند. به همین دلیل در به قالب رشته تبدیل می کنیم
    $random  = strval($randomN);

    
    $data = array('bodyId' => 242394, 'to' => $phone, 'args' => [$random]);
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
}