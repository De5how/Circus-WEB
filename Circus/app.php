<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Купить билет</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
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
<div class="wow">
    <h1 align="center" style="color: white; margin-top: 4%">Перед покупкой билета убедитесь в корректности данных!</h1>


    <form  method="POST">
        <p align="center" style="margin-top: 4%"><input class="input" list="clients" name="client" placeholder="Введите логин"></p>
        <datalist id="clients" >


            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'circus1');
            $clientsSearch = mysqli_query($conn,"SELECT * FROM users ");
            for ($i=0; $i < mysqli_num_rows($clientsSearch); $i++)
            {
                $client = mysqli_fetch_array($clientsSearch, MYSQLI_ASSOC);
                echo "<option>".$client["login"]."</option>";
            }
            ?>


        </datalist>
        <p align="center"><input class="input" list="procedures" name="procedure" placeholder="Введите цирк"></p>
        <datalist id="procedures" >
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'circus1');
            $clientsSearch = mysqli_query($conn,"SELECT * FROM билеты ");
            for ($i=0; $i < mysqli_num_rows($clientsSearch); $i++)
            {
                $client = mysqli_fetch_array($clientsSearch, MYSQLI_ASSOC);
                echo "<option>".$client["Name_circus"]."</option>";
            }
            ?>
        </datalist>
        <p align="center" style="color: white"><input class="input" type ="date" name="date"></p>
        <p align="center" style="color: white"><input class="input" type="time" name="appt"></p>
                <p align="center"><button class="submit" type ="submit" name="create" style="    background-color: #4CAF50; /* Green */
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
    border-radius:10px;">Купить</button></p>
                <p align="center"><a href="main.html" style="    background-color: #4CAF50; /* Green */
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
                    border-radius:10px;">В главное меню</a></p>
    </form>
    <BR>
    <BR>
</div>
<?php
require "db.php";
$conn = mysqli_connect('localhost', 'root', '', 'circus1');
$data = $_POST; //Ассоциативный массив данных
if(isset($data['create'])){ // Записывает данные в $data


    $test=$data['client'];
    $result = mysqli_query($conn,"SELECT * FROM users  WHERE `login`='$test'"); //Вывод ФИО пользователя
    $Fio = mysqli_fetch_assoc($result);
    $idFIO=$Fio["id"];

    $test=$data['procedure'];
    $result = mysqli_query($conn,"SELECT * FROM билеты  WHERE `Name_circus`='$test'");
    $Fio = mysqli_fetch_assoc($result);
    $idProcedure=$Fio["id"];
    $price=$Fio['price'];

    $time=$data['appt'];
    $date=$data['date'];
    $time1= $time.":00";
    echo $time1;
    mysqli_query($conn, "INSERT INTO `купленные_билеты` (`id`, `id_zritel`, `id_slot`, `date`, `time`) VALUES (NULL, '$idFIO', '$idProcedure', '$date', '$time1')");
    echo "<p align='center' style='color:white;'>Удачно! ".$data['client']." , Вы купили билет в цирк - ".$data['procedure']." стоймостью :".$price." рублей</p>";

}
?>

<table class="table" style="color: white; margin-top: 4%">
    <tr>
        <th>НАЗВАНИЕ ЦИРКА:</th>
        <th>ЦЕНА БИЛЕТА:</th>
        <th>ОСТАЛОСЬ МЕСТ:</th>
    </tr>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'circus1');
    $clientsSearch = mysqli_query($conn,"SELECT * FROM билеты ");
    for ($i=0; $i < mysqli_num_rows($clientsSearch); $i++)
    {
        $client = mysqli_fetch_array($clientsSearch, MYSQLI_ASSOC);
        echo "<tr><th>".$client['Name_circus']."</th><th>".$client['price']."</th><th>".$client['slot']."</th></tr>";
    }
    ?>
</table>
</body>
</html>