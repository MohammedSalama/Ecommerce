<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Component;

class AdminAddCategoryComponent extends Component
{
    /**
     * @var
     */
    public $name;

    /**
     * @var
     */
    public $slug;

    /**
     * @return void
     */
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }

    /**
     * @param $failds
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updated($failds)
    {
        $this->validateOnly($failds, [
            'name' => 'required',
            'slug' => 'required'
        ]);
    }

    /**
     * @return void
     */
    public function storeCateory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);
        $category = new Category();
        $category->name = $this->name;
        $category->slug = $this->slug;
        $category->save();
        session()->flash('message', 'Category has been created successfully !');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.admin.admin-add-category-component');
    }
}
