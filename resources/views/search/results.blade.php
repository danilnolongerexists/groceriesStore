@include('includes.header')

<section class="main-section">

    <aside>
        <div class="categories">
            <h2 align='center'>Категории</h2>
            <div class="category-wrap">
                @foreach ($categories as $category)
                    <div class="category">
                        <a class="categorya" href="{{ route('category.show', $category) }}">
                            <img class="category-img" src="{{ $category->image }}" alt="{{ $category->name }}">
                            <div>
                                <p>{{ $category->name }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </aside>

    <main class="main-index">
        <div class="main-index-title">
            <h1>Результаты поиска для "{{ $query }}"</h1>
        </div>
        <div class="main-index-wrap">
            @if ($products->isEmpty())
                <p>Товары не найдены.</p>
            @else
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
            @endif
            {{ $products->appends(['query' => $query])->links() }}
        </div>
    </main>

</section>
<script src="{{ asset('js/modalProduct.js') }}"></script>
