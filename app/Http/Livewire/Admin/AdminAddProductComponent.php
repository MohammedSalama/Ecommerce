<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Str;
use Livewire\Component;

class AdminAddProductComponent extends Component
{
    /**
     * @var
     */
    public $name;
    public $slug;
    public $short_description;
    public $description;
    public $regular_price;
    public $sale_price;
    public $sku;
    public $stock_status = 'instock';
    public $featured = 0;
    public $quantity;
    public $image;
    public $category_id;

    /**
     * @return void
     */
    public function generateSlug()
    {
        $this->slug = Str::slug($this->name);
    }



    public function render()
    {
        return view('livewire.admin.admin-add-product-component');
    }
}
