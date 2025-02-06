@include('includes.header')

<section class="main-section">

    <aside>
        <div class="categories">
            <h2>Категории</h2>
            @foreach ($categories as $category)
            <div class="category">
                <img src="{{ $category->image }}" alt="{{ $category->name }}" style="height: 80px; object-fit: cover;">
                <div>
                    <h2><a href="{{ route('category.show', $category) }}">{{ $category->name }}</a></h2>
                </div>
            </div>
            @endforeach
        </div>
    </aside>

    <main class="main-index">
        <h1>Результаты поиска для "{{ $query }}"</h1>

        @if ($products->isEmpty())
            <p>Товары не найдены.</p>
        @else
            <ul>
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <button id="openProductModalBtn" onclick="setproducttemp({{ json_encode($product->id) }})">{{ $product->name }}</button>
                                {{-- <p class="card-title">{{ $product->name }}</p> --}}
                                <p class="card-title">{{ $product->price }} ₽</p>
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
                                            {{ $inCart->count }}
                                            <form action="{{ route('cart.increase', $product) }}" method="POST" style="margin-left: 10px;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">+</button>
                                            </form>
                                        </div>
                                    @else
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Добавить в корзину</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
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
            </ul>
        @endif

        {{ $products->appends(['query' => $query])->links() }}
    </main>

</section>
<script src="{{ asset('js/modalProduct.js') }}"></script>
