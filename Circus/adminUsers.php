<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать пользователей</title>
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
    <?php
    require "db.php";

    $data = $_POST; //Ассоциативный массив данных
    if(isset($data['do_signup'])){ // Записывает данные в $data
        if(trim($data['login'])=='') //Проверка логина
        {
            $error[]='Введите логин!';
        }
        if($data['password']=='') // Проверка пароля
        {
            $error[]='Введите пароль!';
        }
        if($data['password']!=$data['password_2']) //Проверка повторного пароля
        {
            $error[]='Введенный пароль введен не верно!';
        }
        if(R::count('users',"login = ?",array($data['login']))>0){ //ПРоверка на повторную регистрацию
            $error[]='Пользователь с таким логином уже существует';
        }
        if(empty($error)){ // Проверяем на наличие ошибок
            $user = R::dispense('users'); // Выбираем таблицу users
            $user->login = $data['login']; // вносим туда информацию логина
            $user->password = password_hash($data['password'],PASSWORD_DEFAULT); //Шифровка пароля
            $user->score = 0; // Записываем информацию об очках
            R::store($user);// Перенос в бд
            header('Location: adminUsers.php');//Переадресация
        }else{
            echo '<div style="color:red;">'.array_shift($error).'</div><HR>'; //array_shift достает первый эллемент массива
        }
    }
    ?>
</div>
<div class="login" align="center">
    <h1 style="color: white; margin-top: 5%">Введите данные для регистрации пользователя</h1>
    <form action="adminUsers.php" method="POST">
        <p><input type ="text" name="login" value="<?php echo @$data['login']?>" placeholder="Введите Логин" ></p>
        <p><input type ="password" name="password" value="<?php echo @$data['password']?>" placeholder="Введите Пароль"></p>
        <p><input type ="password" name="password_2" value="<?php echo @$data['password_2']?>" placeholder="Повторите Пароль"></p>
        <h3 style="color:white; margin-top: 1%;">Перед нажатием кнопки "Зарегистрировать" проверьте правильность введенных данных<h3>
        <p class="submit"><button type ="submit" name="do_signup" style="    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    margin-top: 1%;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    background-color: purple;
    padding:10px;
    border-radius:10px;">Зарегистрировать</button></p>
        <p align="center"><a href="adminlob.html " style=" border: none;
                        color: white;
                        margin-top: 1%;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        cursor: pointer;
                        background-color: purple;
                        padding:10px;
                        border-radius:10px;">В лобби</a></p>
    </form>
</div>
<div>
    <form action="adminUsers.php" method="POST">
        <h1 align="center" style="color: white; margin-top: 4%; margin-bottom: 2%">Удалить пользователя</h1>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "circus1");
        if (!$conn) {
            die("Ошибка: " . mysqli_connect_error());
        }
        $sql = "SELECT * FROM users";
        if($result = mysqli_query($conn, $sql)){
            echo "<table style='color: white; margin-left: 45%'>";
            foreach($result as $row){
                echo "<tr>";
                echo "<td style='margin-left: 45%; color: white; font-size: 150%'>" . $row["login"] . "</td>";
                echo "<td><form action='deleteUsers.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' value='Удалить' style='border: none;
                        color: white;
                        margin-top: 1%;
                        padding: 15px 32px;
                        text-align: center;
                        text-decoration: none;
                        display: inline-block;
                        font-size: 16px;
                        cursor: pointer;
                        background-color: purple;
                        padding:10px;
                        border-radius:10px;'>
                   </form></td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result);
        } else{
            echo "Ошибка: " . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </form>
</div>
</body>
</html>