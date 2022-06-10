<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактировать цирк</title>
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
    $conn = mysqli_connect('localhost', 'root', '', 'circus1');
    $data = $_POST; //Ассоциативный массив данных
    if(isset($data['create'])){ // Записывает данные в $data
        $name=$data['name'];
        $tools=$data['tools'];
        $price=$data['price'];
        mysqli_query($conn, "INSERT INTO `билеты` (`id`, `Name_circus`, `price`, `slot`) VALUES (NULL, '$name', '$price', '$tools');");
    }
    ?>
</div>
<div class="wow1" align="center">
    <h1 align="center" style="color: white">Добавить новый цирк</h1>
    <form action="admin.php" method="POST">
        <h3 style="margin-top: 2%; color: white">Заполните данные</h3>
        <p align="center"><input class="input" type ="text" name="name" value="<?=@$data['name']?>" placeholder="Название цирка" ></p>
        <p align="center"><input class="input" type ="price" name="price" value="<?=@$data['price']?>" placeholder="Цена билета" ></p>
        <p align="center"><input class="input" type ="text" name="tools" value="<?=@$data['tools']?>" placeholder="Количество билетов" ></p>
        <h3 style="color:white; margin-top: 1%;">Перед нажатием кнопки "Добавить" проверьте правильность введенных данных<h3>
                <button type ="submit"  class="submit" name="create" style=" border: none;
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
                        border-radius:10px;">Добавить</button>
                <BR>
    </form>
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
</div>
<div>
    <h1 align="center" style="color: white; margin-top: 4%; margin-bottom: 2%">Удалить цирк</h1>
    <?php
    $conn = mysqli_connect("localhost", "root", "", "circus1");
    if (!$conn) {
        die("Ошибка: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM билеты";
    if($result = mysqli_query($conn, $sql)){
        echo "<table style='color: white; margin-left: 45%'>";
        foreach($result as $row){
            echo "<tr>";
            echo "<td style='margin-left: 45%; color: white; font-size: 150%'>" . $row["Name_circus"] . "</td>";
            echo "<td><form action='delete.php' method='post'>
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
</div>
</body>
</html>