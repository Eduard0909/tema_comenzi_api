<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Cart::get();

        return response()->json($carts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeCartForUser()
    {
        $users = User::all();

        foreach ($users as $user) {

            $cart = new Cart();

            $cart->name = "Cart for User " . $user->id;
            // $cart->price = 0;
            // $cart->weight = 0;
            // $cart->color = "blue";

            $user->carts()->save($cart);
        

            return response()->json($cart, 200);
        }
    }

        
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $carts = Cart::findOrFail($id);

        if (!$carts) {
            return response()->json('Not found!', 404);
        }

        return response()->json($carts, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'weight' => 'required|numeric',
            'color' => 'required|string|max:255',
        ]);

        $cart->update($validatedData);

        return response()->json($cart, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //   
    }

    public function addProductToCart(Request $request, $id, $productId)
    {
        
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($id);

        $cart->products()->attach($product);
        return response()->json(200);
    }

    
    public function updateProductInCart(Request $request, $id)
    {
        
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'price' => 'numeric',
            'weight' => 'numeric',
            'color' => 'string|max:255',
        ]);

        $cart->products()->updateExistingPivot($product->id, $validatedData);

        return response()->json($cart, 200);
    }

    public function removeProductFromCart($id)
    {
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($id);

        $cart->products()->detach($product);
        return response()->json($cart, 200);    
    }
    
}