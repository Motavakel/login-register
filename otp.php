<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="assets/css/all.min.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ارسال رمز پیامکی</title>
</head>

<body>
    <ul class="notifications"></ul>
    <div class="container" id="container">
        <div class="otp-class">
            <form method="POST" action="functions/otp-funcs.php" style="width:75%">
                <?php if (isset($_GET['signin']) && $_GET['signin'] == 'successinputnumber'): ?>
                <h3>کد یکبار مصرف دریافتی را در فیلد زیر وارد کنید</h3>
                <input required name="phonenumber" type="text" pattern="[0-9]{4}" placeholder="کد تایید">
                <button name="signin">ارسال</button>
                <?php else: ?>
                <h1>فراموشی رمز</h1>
                <span>شماره همراه تان را وارد نمایید</span>
                <input required name="phonenumber" type="tel" pattern="[0-9]{11}" placeholder="شماره همراه">
                <button name="signin">ارسال کد</button>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <script src="assets/js/script.js">
    
    </script>
</body>

</html>