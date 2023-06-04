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
<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PATCH')
    <input value="{{ $product->name }}" ex name="name" placeholder="Название">
    <input value="{{ $product->description }}" name="description" placeholder="Описание">
    <input value="{{ $product->base_price }}" name="base_price" placeholder="Базовая цена">
    <input value="{{ $product->discount_price }}" name="discount_price" placeholder="Цена со скидкой">
    <button>Отправить</button>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>

</body>
</html>
