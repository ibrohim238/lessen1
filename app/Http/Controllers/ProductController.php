<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController
{
    public function index()
    {
        $products = Product::all();

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
    }

    public function create()
    {
        /* @var User $user*/
        $user = Auth::user();
        if (!is_null($user)) {
            return view('products.create');
        } else {
            return redirect()->route('products.index')
                ->with('error', 'Ты не авторизован');
        }
    }

    public function show(int $id)
    {
        /*
     * {
     *      name => Чипсы,
     *      description => Очень вкусные чипсы,
     *      base_price => 100,
     *      discount_price => null,
     * },
     * */

        $product = Product::findOrFail($id);

        return view('products.show', [
            'product' => $product
        ]);
    }

    public function store(Request $request)
    {
        /* @var User $user*/
        $user = Auth::user();
        if (!is_null($user)) {
            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:1000'],
                'base_price' => ['required', 'int'],
                'discount_price' => ['nullable', 'int', 'before:base_price']
            ]);

            Product::create($validator->validated() + ['user_id' => $user->id]);

            return redirect()->route('products.index')
                ->with('success', 'Успешно создан');
        } else {
            return redirect()->route('products.index')
                ->with('error', 'Ты не авторизован');
        }
    }

    public function edit(int $id)
    {
        /* @var User $user*/
        $user = Auth::user();
        if (!is_null($user)) {
            $product = Product::findOrFail($id);

            return view('products.edit', [
                'product' => $product
            ]);
        } else {
            return redirect()->route('products.index')
                ->with('error', 'Ты не авторизован');
        }
    }

    public function update(int $id, Request $request)
    {
        /* @var User $user */
        $user = Auth::user();
        if (!is_null($user)) {
            /* @var Product $product */
            $product = Product::findOrFail($id);

            if ($product->user_id !== $user->id) {
                return redirect()
                    ->route('products.index')
                    ->with('error', 'Это не ваш продукт иди гуляй!');
            }

            $data = $request->all();

            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string', 'max:1000'],
                'base_price' => ['required', 'int'],
                'discount_price' => ['nullable', 'int', 'before:base_price'],
            ]);

            $product->update($validator->validated());

            return redirect()->route('products.index')
                ->with('success', 'Успешно обновлен');
        } else {
            return redirect()->route('products.index')
                ->with('error', 'Ты не авторизован');
        }
    }

    public function destroy(int $id)
    {
        /* @var User $user*/
        $user = Auth::user();
        if (!is_null($user)) {
            /* @var Product $product */
            $product = Product::findOrFail($id);

            if ($product->user_id !== $user->id) {
                return redirect()
                    ->route('products.index')
                    ->with('error', 'Это не ваш продукт иди гуляй!');
            }

            $product->delete();

            return redirect()->route('products.index')
                ->with('success', 'Успешно удален');
        } else {
            return redirect()->route('products.index')
                ->with('error', 'Ты не авторизован');
        }
    }
}
