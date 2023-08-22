<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class DetailsComponent extends Component
{
    /**
     * @var
     */
    public $slug;

    /**
     * @param $slug
     * @return void
     */
    public function mount($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
//        dd($this->slug);
        $product = Product::where('slug',$this->slug)->first();
        $rproducts = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::latest()->take(4)->get();
        return view('livewire.details-component',['product' => $product, 'rproducts' => $rproducts , 'nproducts' => $nproducts]);
    }
}
