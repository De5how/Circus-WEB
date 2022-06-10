<?php
require "db.php";  //Подключаемся к нашей БД
$data = $_POST; //Создаем ассиативный массив Данных
if(isset($data['do_login'])){ // Проверка на существования заполненных данных
    $error = array(); // Массив Ошибок
    $user = R::findOne('users','login = ?',array($data['login'])); //Выборка по логину из бд
    if($user){
        if(password_verify($data['password'],$user->password)){   // Проверка введеного пароля на подлинность
        $_SESSION['logged_user']=$user; // Создание сессии с информацией по пользователю
        header('Location: /');
        }else{
            $error[]='Пароль не подходит';
        }
    }else{
        $error[]='Пользователь не найден!';
    }


    if( !empty($error)){ // Проверяем на наличие ошибок
        echo '<div style="color:red;">'.array_shift($error).'</div><HR>'; //array_shift достает первый эллемент массива
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 
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
  <section class="container" align="center">
    <div class="login">
      <h1 style="color: white; margin-top: 10%">Войти в личный кабинет</h1>
      <form action="login.php" method="POST">
        <p><input type ="text" name="login" value="<?php echo @$data['login']?>" placeholder="Введите логин" ></p>
        <p><input type ="password" name="password" value="<?php echo @$data['password']?>" placeholder="Введите пароль"></p>
        <p class="submit"><button type ="submit" name="do_login" style="    background-color: #4CAF50; /* Green */
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
    border-radius:10px;">Авторизоваться</button></p>
      </form>
    </div>
  </section>
</body>
</html>