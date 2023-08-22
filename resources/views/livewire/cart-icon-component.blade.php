    <div class="header-action-right">
        <div class="header-action-2">
            <div class="header-action-icon-2">
                <a href="shop-wishlist.php">
                    <img class="svgInject" alt="Surfside Media"
                         src="{{ URL::asset('layouts/assets/imgs/theme/icons/icon-heart.svg') }}">
                    <span class="pro-count blue">4</span>
                </a>
            </div>
            <div class="header-action-icon-2">
                <a class="mini-cart-icon" href="{{ URL::route('shop.cart') }}">
                    <img alt="cart"
                         src="{{ URL::asset('layouts/assets/imgs/theme/icons/icon-cart.svg') }}">
                    @if(Cart::count() > 0)
                        <span class="pro-count blue">{{ Cart::count() }}</span>
                    @endif
                </a>
                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                    <ul>
                        @foreach(Cart::content() as $item)
                            <li>
                                <div class="shopping-cart-img">
                                    <a href="{{ route('product.details',['slug'=>$item->model->slug]) }}"><img alt="{{$item->model->name}}"
                                                                        src="{{ asset('layouts/assets/imgs/shop/product-')}}{{$item->model->id}}-2.jpg"></a>
                                </div>
                                <div class="shopping-cart-title">
                                    <h4><a href="{{ route('product.details',['slug'=>$item->model->slug]) }}">{{ substr($item->model->name,0,20) }}....</a></h4>
                                    <h4><span>{{ $item->qty }} × </span>${{ $item->model->regular_price }}</h4>
                                </div>
{{--                                <div class="shopping-cart-delete">--}}
{{--                                    <a href="#"><i class="fi-rs-cross-small"></i></a>--}}
{{--                                </div>--}}
                            </li>
                        @endforeach

                    </ul>
                    <div class="shopping-cart-footer">
                        <div class="shopping-cart-total">
                            <h4>Total <span>${{ Cart::total() }}</span></h4>
                        </div>
                        <div class="shopping-cart-button">
                            <a href="{{ URL::route('shop.cart') }}" class="outline">View cart</a>
                            <a href="{{ URL::route('shop.checkout') }}">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

