<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryComponent extends Component
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

    public $slug;

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
        $category = Category::where('slug', $this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;

        if ($this->orderBy == 'Price: Low to High') {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } elseif ($this->orderBy == 'Price: High to Low') {
            $products = Product::where('category_id', $category_id)->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } elseif ($this->orderBy == 'Sort By Newness') {
            $products = Product::where('category_id', $category_id)->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::where('category_id', $category_id)->paginate($this->pageSize);
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('livewire.category-component', ['products' => $products, 'categories' => $categories, 'category_name' => $category_name]);
    }
}
