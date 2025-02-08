@include('includes.header')

<section class="main-section-categories">
    <main class="main-index">
        <div class="products-title">
            <h2>{{ $category->name }}</h2>
        </div>
        <div class="product-wrap">
            @foreach ($products as $product)
            <a id="openProductModalBtn" onclick="setproducttemp({{ json_encode($product->id) }})">
                <div class="product">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}">
                    <p>{{ $product->name }}</p></a>
                    @auth
                        @php
                            $inCart = \App\Models\Cart::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->first();
                        @endphp
                        @if ($inCart)
                            <p>{{ $product->price }} ₽</p>
                            <div style="display: flex; align-items: center;">
                                <form action="{{ route('cart.decrease', $product) }}" method="POST" style="margin-right: 10px;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">-</button>
                                </form>
                                {{ $inCart->count }}
                                <form action="{{ route('cart.increase', $product) }}" method="POST" style="margin-left: 10px;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">+</button>
                                </form>
                            </div>
                        @else
                            <form class="product-notadd" action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <p>{{ $product->price }} ₽</p>
                                <button type="submit" class="btn btn-primary">+</button>
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
                                <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                <p class="card-title">{{ $product->description }}</p>
                                <p class="card-title">{{ $product->price }} ₽</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </main>

    <aside>
        <div class="categories">
            <h2 align='center'>Категории</h2>
            @foreach ($categories as $category)
            <a class="categorya" href="{{ route('category.show', $category) }}">
                <div class="category">
                    <img src="{{ $category->image }}" alt="{{ $category->name }}">
                    <div>
                        <p>{{ $category->name }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </aside>
</section>

<script src="{{ asset('js/modalProduct.js') }}"></script>
