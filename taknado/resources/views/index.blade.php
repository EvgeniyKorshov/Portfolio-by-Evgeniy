<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Сборщик данных о организациях или физ.  лицах с сервиса dadata.ru</title>
</head>
<body>
    <h1>Введите инн компании чтобы сохранить его в базу</h1>
                <form action="/result" method="POST">
                    @csrf
                    <input name="inn">
                    <input type="submit">
                </form>
</body>
</html>
