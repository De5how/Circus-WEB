<?php
if(isset($_POST["id"]))
{
    $conn = mysqli_connect("localhost", "root", "", "circus1");
    if (!$conn) {
        die("Ошибка: " . mysqli_connect_error());
    }
    $userid1 = mysqli_real_escape_string($conn, $_POST["id"]);
    $sql = "DELETE FROM users WHERE id = '$userid1'";
    if(mysqli_query($conn, $sql)){

        header("Location: adminUsers.php");
    } else{
        echo "Ошибка: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>