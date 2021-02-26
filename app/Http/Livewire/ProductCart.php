<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class ProductCart extends Component
{
    public function increaseQty($rowId)
    {
        $product = Cart::get($rowId);
        $qty =$product->qty + 1;
        Cart::update($rowId,$qty);
    }

    public function decreaseQty($rowId)
    {
        $product = Cart::get($rowId);
        $qty =$product->qty - 1;
        Cart::update($rowId,$qty);

    }

    public function destroy($rowId)
    {
        Cart::remove($rowId);
        session()->flash('success_message','Item has been removed !');
    }

    public function destroyAll()
    {
        cart::destroy();
    }

    public function render()
    {
        return view('livewire.product-cart')->layout('layouts.base');
    }
}
