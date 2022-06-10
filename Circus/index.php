<?php
require "db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Вход</title>
        <link rel="stylesheet" href="style.css">
    </head>
<body>
<div class="header">
    <div class="header_section">
        <div class="header_item headerLogo">
            <a href="main.html"><img src="logo.svg" width="60" height="60" alt=""></a>
        </div>
        <div class="header_item headerButton">
            <a href="/news.html">Новости</a>
        </div>
        <div class="header_item headerButton">
            <a href="/app.php">Купить билеты</a>
        </div>
        <div class="header_item headerButton">
            <a href="/adminlob.html">Админ панель</a>
        </div>
    </div>
    <div class="header_section">
        <div class="header_item headerButton">
            <a href="/index.php">Вход</a>
        </div>
        <div class="header_item headerButton">
            <a href="tel:88005553535">8 800 555 35 35</a>
        </div>
    </div>
</div>

<section class="container">
    <div class="login">
        <?php if(isset($_SESSION['logged_user'])) : ?>  <!-- Проверка на авторизованность пользователя -->
            <h1 style="text-align: center; color: white"> Привет, <?php echo $_SESSION['logged_user']->login; ?>!</h1>
            <a href="/main.html" style="    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    margin-top:10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left:25%;
    cursor: pointer;
    padding:10px;
    border-radius:10px;
    background-color: purple;">В главное меню</a>
            <a href="/logout.php" style="    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    margin-top:10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-left:25%;
    cursor: pointer;
    padding:10px;
    border-radius:10px;
    background-color: purple;">Выйти из аккаунта</a>
        <?php else:?>
            <h1 style="text-align: center; color: white; margin-top: 10%"> Вы не авторизованы</h1>
            <a  href="login.php" style="    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    margin-left:42%;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    background-color: purple;
    padding:10px;
    border-radius:10px;">Авторизация</a>
            <a href="signup.php" style="    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    margin-top:10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    background-color: purple;
    padding:10px;
    border-radius:10px;">Регистрация</a>

        <?php endif; ?>
    </div>
</section>
</body>
</html>