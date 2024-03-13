<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM users WHERE email=:email");
        $query->bindParam("email", $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            echo '<p class="error">Неверная комбинация почты пользователя и пароля!</p>';
        } else {
            if (password_verify($password, $result['password']) ) {
                $_SESSION['user_id'] = $result['id'];
                header('Location: index.php');
            } else {
                echo '<p class="error">Неверная комбинация почты пользователя и пароля!</p>';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="/style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Вход</title>
</head>
<body>
<form method="post" action="" name="signin-form">
  <div class="form-element">
    <label>Почта</label>
    <input type="email" name="email" required />
  </div>
  <div class="form-element">
    <label>Пароль</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Вход</button>
</form>
<a href="login_phone.php">Войти по телефону</a>
</body>
</html>
