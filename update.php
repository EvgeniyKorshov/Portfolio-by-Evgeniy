
<!DOCTYPE html>
<html>
<head>
<title>Измение данных</title>
<meta charset="utf-8" />
</head>
<body>
<?php
session_start();
include('config.php');


if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"]))
{
    $userid = $_GET["id"];
    $sql = "SELECT * FROM users WHERE id = :userid";
    $query = $connection->prepare($sql);
    $query->bindValue(":userid", $userid);
    $query->execute();
    if($query->rowCount() > 0){
        foreach ($query as $row) {
            $username = $row["username"];
            $phone = $row["phone"];
            $email = $row["email"];
        }
        echo "<h3>Обновление данных пользователя</h3>
                <form method='post'>
                    <input type='hidden' name='id' value='$userid' />
                    <p>Имя:
                    <input type='text' name='username' value='$username' /></p>
                    <p>Телефон:
                    <input type='number' name='phone' value='$phone' /></p>
                    <p>Почта:
                    <input type='email' name='email' value='$email' /></p>
                    <input type='submit' value='Сохранить' />
            </form>";
    }
    else{
        echo "Пользователь не найден";
    }
}
elseif (isset($_POST["id"]) && isset($_POST["username"]) && isset($_POST["phone"]) && isset($_POST["email"])) {
      
    $sql = "UPDATE users SET username = :username, phone = :phone, email = :email WHERE id = :userid";
    $stmt = $connection->prepare($sql);
    $stmt->bindParam(":userid", $_POST["id"]);
    $stmt->bindParam(":username", $_POST["username"]);
    $stmt->bindParam(":phone", $_POST["phone"]);
    $stmt->bindParam(":email", $_POST["email"]);
          
    $stmt->execute();
    header("Location: index.php");
}
else{
    echo "Некорректные данные";
}
?>
</body>
</html>