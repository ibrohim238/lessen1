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
    @if(Auth::check())
        <a href="{{ route('logout') }}">
            Выйти
        </a>
    @else
        <a href="{{ route('login') }}">
            Авторизоваться
        </a>
    @endif

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
    @if(Session::has('error'))
        <div style="background: #ef4444">
            {{ Session::get('error') }}
        </div>
    @endif
    @if(Session::has('success'))
        <div style="background: lime">
            {{ Session::get('success') }}
        </div>
    @endif

</body>
</html>
