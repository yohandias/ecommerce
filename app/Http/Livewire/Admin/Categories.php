<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Category;

class Categories extends Component
{
    use WithPagination;

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        SesSion()->flash('message','Category deleted successfully!');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.categories',['categories'=>$categories])->layout('layouts.base');
    }
}
