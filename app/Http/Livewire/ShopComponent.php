<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class ShopComponent extends Component
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
     * @var int
     */
    public $min_value = 0;

    /**
     * @var int
     */
    public $max_value = 1000;

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
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        elseif ($this->orderBy == 'Price: High to Low')
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        elseif ($this->orderBy == 'Sort By Newness')
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else
        {
            $products = Product::whereBetween('regular_price',[$this->min_value,$this->max_value])->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name','ASC')->get();
        return view('livewire.shop-component', ['products' => $products , 'categories' => $categories]);
    }
}
