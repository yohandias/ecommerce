<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\WithPagination;
use Cart;

class ProductCategory extends Component
{
    public $slug;
    public $sorting;
    public $pagesize;


    //public function render()
    //{
       // $category = Category::where('slug', $this->slug)->first();
       // return view('livewire.product-category',['category'=>$category])->layout('layouts.base');
   // }

    public function mount($slug)
    {
        $this->sorting = "default";
        $this->pagesize = 6;
        $this->slug = $slug;
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\product');
        session()->flash('success_message','Item added in to the cart !');
        return redirect ()->route('product.cart');
    }

    use WithPagination;
    public function render()
    {
        $category = Category::where('slug',$this->slug)->first();
        $category_id =$category->id;
        $category_name =$category->name;

        if($this->sorting=='date')
        {
            $products = Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price')
        {
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price-desc')
        {
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::where('category_id',$category_id)->paginate($this->pagesize);
        }

        $categories = Category::all();

        $popular_products = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.product-category',[
            'products'=> $products,
            'popular_products'=> $popular_products,
            'categories'=>$categories,
            'category_name'=>$category_name
        ])->layout('layouts.base');
    }
}
