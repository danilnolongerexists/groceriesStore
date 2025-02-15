@foreach ($products as $product)
    <div class="product">
        <a id="openProductModalBtn" onclick="setproducttemp({{ json_encode($product->id) }})">
        <img src="{{ $product->image }}" alt="{{ $product->name }}">
        <div>
            <p>{{ $product->name }}</p>
        </div>
        </a>
        @auth
            @php
                $inCart = \App\Models\Cart::where('user_id', auth()->id())
                    ->where('product_id', $product->id)
                    ->first();
            @endphp
            @if ($inCart)
                <div class="inCart">
                    <form class="cart-decrease" action="{{ route('cart.decrease', $product) }}" method="POST">
                        @csrf
                        <button type="submit">-</button>
                    </form>
                    {{ $product->price }} ₽
                    <form class="cart-increase" action="{{ route('cart.increase', $product) }}" method="POST">
                        @csrf
                        <button type="submit" >+</button>
                        ({{ $inCart->count }}x)
                    </form>
                </div>
            @else

                <form class="product-notadd" action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    {{ $product->price }} ₽ &nbsp;
                    <button type="submit"> +</button>
                </form>
            @endif
        @endauth
    </div>
    <div id="productModal-{{ $product->id}}" class="modal">
        <div class="modal-content">
            <span class="close" id="closeProduct" onclick="closeProduct()">&times;</span>
            <div id="modalProduct">
                <div id="modalProductInfo">
                    {{-- <div> --}}
                        <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    {{-- </div> --}}
                    <div class="modalProductText">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p><b>{{ $product->price }} ₽</b> за штуку</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
