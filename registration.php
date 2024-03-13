<?php
    session_start();
    include('config.php');
    if (isset($_POST['registration'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = $connection->prepare("SELECT * FROM users WHERE email=:email AND username=:username AND phone=:phone");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->bindParam("username", $username, PDO::PARAM_STR);
        $query->bindParam("phone", $phone, PDO::PARAM_STR);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo '<p class="error">Пользователь с данными параметрами уже существует рекомендуется изменить почту, имя,телефон!</p>';
        }
        if($password == $password_confirm){
            if ($query->rowCount() == 0 ) {
                $query = $connection->prepare("INSERT INTO users(username,password,email,phone) VALUES (:username,:password_hash,:email,:phone)");
                $query->bindParam("username", $username, PDO::PARAM_STR);
                $query->bindParam("password_hash", $password_hash, PDO::PARAM_STR);
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->bindParam("phone", $phone, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    header('Location: login.php');
                } else {
                    echo '<p class="error">Что-то пошло не так!</p>';
                }
            }
        } else {
            echo 'Ошибка подтверждения пароля';
           
        }
       
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<form method="post" action="" >
<div class="form-element">
<label>Имя</label>
<input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
</div>
<div class="form-element">
<label>Почта</label>
<input type="email" name="email" required />
</div>
<div class="form-element">
<label>Телефон</label>
<input type="text" name="phone" required />
</div>
<div class="form-element">
<label>Пароль</label>
<input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Должно содержать по крайней мере одно число, одну заглавную и строчную буквы, а также не менее 8 и более символов" required />
</div>
<div class="form-element">
<label>Проверка пароля</label>
<input type="password" name="password_confirm" required />
</div>

<button type="submit" name="registration" value="registration">Регистрация</button>
</form>
</body>
</html>

