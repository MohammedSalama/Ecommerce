<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartComponent extends Component
{
    /**
     * @param $rowId
     * @return void
     */
    public function increaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty + 1;
        Cart::update($rowId,$qty);
    }

    /**
     * @param $rowId
     * @return void
     */
    public function decreaseQuantity($rowId)
    {
        $product = Cart::get($rowId);
        $qty = $product->qty - 1;
        Cart::update($rowId,$qty);
    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        Cart::remove($id);
        session()->flash('success_message','Item has been removed');
    }

    public function clearAll()
    {
        Cart::destroy();
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.cart-component');
    }
}
