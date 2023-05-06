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
    Че то там
    <a href="{{ route('products.create') }}">
        Добавить товар
    </a>
    <div>
        @foreach($products as $product)
            <a href="{{ route('products.show', $product) }}">
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
            </a>
        @endforeach
    </div>

</body>
</html>
