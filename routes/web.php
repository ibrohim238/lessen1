<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::get('login', function () {
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()
            ->route('products.index')
            ->with('error', 'Ты и так авторизован');
    }

    return view('login');
})->name('login');

Route::post('auth', function (\Illuminate\Http\Request $request) {
    $email = $request->get('email');
    $password = $request->get('password');

    $user = \App\Models\User::query()
        ->where('email', '=', $email)
        ->first();

    if ($user && \Illuminate\Support\Facades\Hash::check($password, $user->password)) {
        Auth::login($user);

        return redirect()
            ->route('products.index')
            ->with('success', 'Успешно авторизован');
    }

    return redirect()
        ->route('login')
        ->with('error', 'Не верный логин или пароль');
})->name('auth');

Route::get('logout', function () {
    if (!\Illuminate\Support\Facades\Auth::check()) {
        return redirect()
            ->route('products.index')
            ->with('error', 'Ты и так не авторизован');
    }

    Auth::logout();

    return redirect()
        ->route('products.index')
        ->with('success', 'Успешно вышел');
})->name('logout');

/*
 * INDEX - список товаров
 * SHOW - товар
 * CREATE - Форма добавления товара
 * STORE - Добавить товар
 * EDIT - Форма редактирования товара
 * UPDATE - Редактировать товар
 * DESTROY - Удалить товар
 * */
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
