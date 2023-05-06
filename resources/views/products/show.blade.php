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
    <a href="{{ route('products.index') }}">
        Перейти обратно
    </a>
    <a href="{{ route('products.edit', $product) }}">
        Редактировать товар
    </a>
    <form method="POST" action="{{ route('products.update', $product) }}">
        @csrf
        @method('DELETE')
        <button>
            Удалить товар
        </button>
    </form>
    <div>
        <div>
            <div>
                {{ $product->name }}
            </div>
            <div>
                {{ $product->description }}
            </div>
            <div>
                {{ $product->base_price }}
            </div>
            <div>
                {{ $product->discount_price }}
            </div>
        </div>
    </div>

</body>
</html>
