<?php

namespace App\Http\Livewire;

Use App\Models\Product;
use Livewire\Component;
use Cart;

class ProductDetails extends Component
{
    public $slug;

    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\product');
        session()->flash('success_message','Item added in to the cart !');
        return redirect ()->route('product.cart');
    }

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::where('slug',$this->slug)->first();
        $popular_products = Product::inRandomOrder()->limit(4)->get();
        $related_products = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(5)->get();
        return view('livewire.product-details',[
            'product'=> $product,
            'popular_products'=> $popular_products,
            'related_products'=> $related_products
            ])->layout('layouts.base');
    }
}
