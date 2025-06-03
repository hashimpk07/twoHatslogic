<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Product;


class CartController extends Controller
{
    protected function getCarts()
    {
        $sessionId = session()->getId();
        return Carts::firstOrCreate(['session_id' => $sessionId]);
        
    }

    public function index()
    {
        $cart = $this->getCart();
        $items = $cart->items()->with('product')->get();
        $total = $items->sum(fn($item) => $item->quantity * $item->product->price);

        return view('cart.index', compact('items', 'total'));
    }

    public function show()
    {
        $carts = $this->getCarts();
        $carts->load('items.product');

        return view('carts.show', compact('carts'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $carts = $this->getCarts();
        $product = Product::findOrFail($request->product_id);

        $quantityToAdd = $request->quantity;
        $existingItem = $carts->items()->where('product_id', $product->id)->first();

        $currentQuantity = $existingItem ? $existingItem->quantity : 0;
        $newQuantity = $currentQuantity + $quantityToAdd;

        if ($newQuantity > $product->stock_quantity) {
            return back()->withErrors(['quantity' => 'Requested quantity exceeds stock available']);
        }

        if ($existingItem) {
            $existingItem->quantity = $newQuantity;
            $existingItem->save();
        } else {
            $carts->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantityToAdd,
            ]);
        }

        return redirect()->route('carts.show')->with('success', 'Product added to carts');
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = $this->getCarts();
        $item = $cart->items()->findOrFail($itemId);
        $product = $item->product;

        $oldQuantity = $item->quantity;
        $newQuantity = $request->quantity;

        if ($newQuantity > $oldQuantity) {
            $diff = $newQuantity - $oldQuantity;

            if ($diff > $product->stock_quantity) {
                return back()->withErrors(['quantity' => 'Requested quantity exceeds available stock.']);
            }

            $product->stock_quantity -= $diff;
        }elseif ($newQuantity < $oldQuantity) {
            $diff = $oldQuantity - $newQuantity;
            $product->stock_quantity += $diff;
        }

        $product->save();

        $item->quantity = $newQuantity;
        $item->save();
        return redirect()->route('products.index')->with('success', 'carts updated');
    }

    public function remove($itemId)
    {
        $carts = $this->getCarts();
        $item = $carts->items()->findOrFail($itemId);
        $item->delete();

        return redirect()->route('carts.show')->with('success', 'Item removed from carts');
    }
}
