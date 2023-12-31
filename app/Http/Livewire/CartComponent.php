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
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');
    }

    /**
     * @param $rowId
     * @return void
     */
    public function decreaseQuantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-icon-component','refreshComponent');

    }

    /**
     * @param $id
     * @return void
     */
    public function destroy($id)
    {
        Cart::instance('cart')->remove($id);
        $this->emitTo('cart-icon-component','refreshComponent');
        session()->flash('success_message','Item has been removed');
    }

    /**
     * @return void
     */
    public function clearAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-icon-component','refreshComponent');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function render()
    {
        return view('livewire.cart-component');
    }
}
