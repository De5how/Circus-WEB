<?php
require "db.php";
 unset($_SESSION['logged_user']); //Закрытие сессии Юзера
 header ('Location: /'); // Перенаправление на index.php
?>