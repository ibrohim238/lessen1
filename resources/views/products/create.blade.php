<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{ route('products.store') }}">
    @csrf
    <input name="name" placeholder="Название">
    <input name="description" placeholder="Описание">
    <input name="base_price" placeholder="Базовая цена">
    <input name="discount_price" placeholder="Цена со скидкой">
    <button>Отправить</button>
</form>

</body>
</html>
