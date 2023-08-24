<div class="header-action-icon-2">
    <a href="{{ route('shop.wishlist') }}">
        <img class="svgInject" alt="wishlist"
             src="{{ URL::asset('layouts/assets/imgs/theme/icons/icon-heart.svg') }}">
        @if(Cart::instance('wishlist')->count() > 0)
            <span class="pro-count blue">{{Cart::instance('wishlist')->count()}}</span>
        @endif
    </a>
</div>
