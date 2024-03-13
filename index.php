

<!DOCTYPE html>
<html>
<head>
<title>Главная</title>
<meta charset="utf-8" />
</head>
<body>
<h2>Список пользователей</h2>
<?php

session_start();
    include('config.php');
    if(!isset($_SESSION['user_id'])){
        header('Location: login.php');
        exit;
    } else {
    
try {
  
    $result = $connection->query("SELECT * FROM users");
    echo "<table><tr><th>Имя</th><th>Телефон</th><th>Почта</th></tr>";
    foreach($result as $row){
        echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td><a href='update.php?id=" . $row["id"] . "'>Изменить</a></td>";
        echo "</tr>";
    }
    echo "</table>";
}
catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}}
?>
</body>
</html>