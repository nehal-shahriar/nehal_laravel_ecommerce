<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class AdminEditCategoryComponent extends Component
{
    public $category_slug;
    public $category_id;
    public $slug;
    public $name;
    public function mount($category_slug){
        $this->category_slug=$category_slug;
        $category=Category::where('slug',$category_slug)->first();
        $this->category_id=$category->id;
        $this->name=$category->name;
        $this->slug=$category->slug;
    }
    public function generateslug(){
        $this->slug=Str::slug($this->name);
    }
    public function updateCategory(){
        $category=Category::where('id',$this->category_id)->first();
        $category->name=$this->name;
        $category->slug=$this->slug;
        $category->save();
        session()->flash('message','Category has been updated successfully');
    }
    public function render()
    {
        return view('livewire.admin.admin-edit-category-component')->layout('layouts.base');
    }
}
