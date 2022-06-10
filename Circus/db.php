<?php
require "libs/rb.php"; //Подключение библиотеки Red Bean
R::setup( 'mysql:host=localhost;dbname=circus1','root', '' ); // Подключение к Базе Данных
if (@session_id() == "") @session_start(); // Запуск сессии
?>