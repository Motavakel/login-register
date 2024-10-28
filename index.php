<?php
include 'config/loader.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لاگین و ریجستر پیامکی</title>
</head>

<body>
    <ul class="notifications"></ul>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST" action="functions/login-register-funcs.php">
                <h1>ایجاد حساب</h1>
                <input  name="name" type="text" placeholder="نام و نام خانوداگی به فارسی وارد کنید">
                <input  name="user_name" type="text" placeholder="نام کاربری را به لاتین وارد کنید" required>
                <input  name="phone" type="tel" pattern="[0-9]{11}" placeholder="شماره موبایل را به لاتین وارد کنید" required>
                <input  name="password" type="password" placeholder="پسورد حداقل شامل ۸ کاراکتر باشد" required>
                <input  name="confirm_password" type="password" placeholder="تکرار دوباره پسورد" required>
                <button name="signup">ثبت نام</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" action="functions/login-register-funcs.php">
                <h1>ورود</h1>
                <span>برای ورود اطلاعات خودتان را وارد کنید</span>
                <input name="key" type="text" placeholder="نام کاربری یا شماره موبایل " required>

                <div class="password-container">
                    <input id="password" name="password" type="password" placeholder="پسورد" required>
                    <span class="toggle-password" onclick="togglePassword()">👁️</span>
                </div>
                
                <a href="otp.php">رمزتان را فراموش کرده اید؟</a>
                <button name="signin">ورود</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>خوش آمده اید</h1>
                    <p>نام،نام خانوادگی ،نام کاربری و پسوردتان را وارد کنید</p>
                    <button class="hidden" id="login">ورود</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>سلام دوست من</h1>
                    <p>برای ثبت نام کلیک کنید</p>
                    <button class="hidden" id="register">تبت نام</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>

</html>