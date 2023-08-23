<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    /**
     * @var int
     */
    public $pageSize = 12;

    /**
     * @var string
     */
    public $orderBy = "Default Sorting";

    /**
     * @var
     */
    public $q;

    /**
     * @var
     */
    public $search_term;

    /**
     * @return void
     */
    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q . '%';
    }

    /**
     * @param $product_id
     * @param $product_name
     * @param $product_price
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Item Added to Cart');
        return redirect()->route('shop.cart');
    }

    /**
     * @param $size
     * @return void
     */
    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    /**
     * @param $order
     * @return void
     */
    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        if ($this->orderBy == 'Price: Low to High')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        elseif ($this->orderBy == 'Price: High to Low')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        elseif ($this->orderBy == 'Sort By Newness')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else
        {
            $products = Product::where('name','like',$this->search_term)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        return view('livewire.search-component', ['products' => $products , 'categories' => $categories]);
    }
}
