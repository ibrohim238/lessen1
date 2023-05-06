<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
 * INDEX - список товаров
 * SHOW - товар
 * CREATE - Форма добавления товара
 * STORE - Добавить товар
 * EDIT - Форма редактирования товара
 * UPDATE - Редактировать товар
 * DESTROY - Удалить товар
 * */

Route::get('/products', function () {
    $products = \App\Models\Product::all();

    /*
     * [
     *  {
     *      name => Чипсы,
     *      description => Очень вкусные чипсы,
     *      base_price => 100,
     *      discount_price => null,
     *  },
     *  {
     *      name => Бургер,
     *      description => Очень вкусные бургеры,
     *      base_price => 300,
     *      discount_price => null,
     *  }
     * ]
     *
     * */

    return view('products.index', [
        'products' => $products
    ]);
})->name('products.index');

Route::get('/products/create', function () {
    return view('products.create');
})->name('products.create');

Route::get('/products/{id}', function (int $id) {
    /*
     * {
     *      name => Чипсы,
     *      description => Очень вкусные чипсы,
     *      base_price => 100,
     *      discount_price => null,
     * },
     * */
    $product = \App\Models\Product::findOrFail($id);

    return view('products.show', [
        'product' => $product
    ]);
})->name('products.show');

Route::post('/products', function (\Illuminate\Http\Request $request) {
    $data = $request->all();

    $validator = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:1000'],
        'base_price' => ['required', 'int'],
        'discount_price' => ['nullable', 'int'],
    ]);

    \App\Models\Product::create($validator->validated());

    return redirect()->route('products.index');
})->name('products.store');

Route::get('/products/{id}/edit', function (int $id) {
    $product = \App\Models\Product::findOrFail($id);

    return view('products.edit', [
        'product' => $product
    ]);
})->name('products.edit');

Route::patch('/products/{id}', function (int $id, \Illuminate\Http\Request $request) {
    /* @var \App\Models\Product $product*/
    $product = \App\Models\Product::findOrFail($id);

    $data = $request->all();

    $validator = Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:1000'],
        'base_price' => ['required', 'int'],
        'discount_price' => ['nullable', 'int'],
    ]);

    $product->update($validator->validated());

    return redirect()->route('products.index');
})->name('products.update');

Route::delete('/products/{id}', function (int $id) {
    /* @var \App\Models\Product $product*/
    $product = \App\Models\Product::findOrFail($id);

    $product->delete();

    return redirect()->route('products.index');
})->name('products.destroy');
