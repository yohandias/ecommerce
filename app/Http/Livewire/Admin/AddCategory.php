<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
class AddCategory extends Component
{
    public $name;
    public $slug;

    public function generateslug()
    {
        $this->slug =Str::slug($this->name);
    }

    public function store()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message','Category has been created successfully !');
        return redirect ()->route('admin.categories');
    }
    public function render()
    {
        return view('livewire.admin.add-category')->layout('layouts.base');
    }
}
