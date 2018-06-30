<?php
session_start();

if ((isset($_SESSION['logged']) && $_SESSION['logged'] === true)
    || (isset($_POST['password']) && $_POST['password'] === 'elmortafea3rel7la')) {
    $_SESSION['logged'] = true;
    header('location: /admin');
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اختارلي فيلم</title>
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <link rel="stylesheet" href="../style-003.css">
    <script defer src="https://use.fontawesome.com/releases/v5.1.0/js/all.js"
            integrity="sha384-3LK/3kTpDE/Pkp8gTNp2gR/2gOiwQ6QaO7Td0zV76UFJVhqLl4Vl3KL1We6q6wR9"
            crossorigin="anonymous"></script>
</head>
<body>
<br><br><br><br>
<form method="post">
    <h3>دخل كلمة السر يا زعيم</h3>

    <input autofocus class="password" type="password" name="password">
    <?php if(isset($_POST['password'])) : ?>
    <div style="color: red">
        ركز يا حج
    </div>
    <?php endif; ?>
    <div class="login">
        <button type="submit" class="btn">يلا</button>
    </div>
</form>
<footer>
    <p>
        Made for fun by @ <a target="_blank" href="https://facebook.com/error17191">Mohamed Ahmed</a>
    </p>
</footer>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</body>
</html>