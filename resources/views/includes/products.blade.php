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
                <div style="display: flex; align-items: center;">
                    <form action="{{ route('cart.decrease', $product) }}" method="POST" style="margin-right: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-danger">-</button>
                    </form>
                    {{ $product->price }} ₽
                    <form action="{{ route('cart.increase', $product) }}" method="POST" style="margin-left: 10px;">
                        @csrf
                        <button type="submit" class="btn btn-success">+</button>
                        ({{ $inCart->count }} шт.)
                    </form>
                </div>
            @else

                <form class="product-notadd" action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    {{ $product->price }} ₽ &nbsp;
                    <button type="submit" class="btn btn-primary"> +</button>
                </form>
            @endif
        @endauth
    </div>
    <div id="productModal-{{ $product->id}}" class="modal">
        <div class="modal-content">
            <span class="close" id="closeProduct">&times;</span>
            <div id="modalProduct">
                <h2>{{ $product->name }}</h2>
                <div id="modalProductInfo" style="display: flex;flex-direction: column;align-items: flex-start;">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    <p class="card-title">{{ $product->description }}</p>
                    <p class="card-title">{{ $product->price }} ₽</p>
                </div>
            </div>
        </div>
    </div>
@endforeach
