<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoriesComponent extends Component
{
    public $category_id;
    use WithPagination;

    /**
     * @return void
     */
    public function deleteCategory()
    {
        $category = Category::find($this->category_id);
        $category->delete();
        session()->
        flash('message','Category has been deleted successfully !');
    }
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        $categories = Category::orderBy('name','ASC')->paginate(2);
        return view('livewire.admin.admin-categories-component',['categories' => $categories]);
    }
}
