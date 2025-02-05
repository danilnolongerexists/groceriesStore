@include('includes.header')

<div class="cart">
    <div>
        <div>
            <h1>Корзина</h1>
            <p>Добро пожаловать на страницу вашей корзины, {{ Auth::user()->name }}!</p>

            @if($products->isEmpty())
                <p>Ваша корзина пуста.</p>
            @else
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($products as $product)
                        @if($product->product) <!-- Проверяем, что $product->product не null -->
                            @php
                                $total += $product->product->price * $product->count;
                            @endphp
                            <tr>
                                <td><img class="card-img-top" id="modal-cart-image" src="{{ $product->product->image }}" alt="{{ $product->product->name }}" style="height: 60px; width:60px; object-fit: cover;"></td>
                                <td><button id="openProductModalBtn" onclick="setproducttemp({{ json_encode($product->product->id) }})">{{ $product->product->name }}</button></td>
                                <td>{{ $product->product->price * $product->count }} ₽</td>
                                <td>
                                    <div style="display: flex; align-items: center;">
                                        <form action="{{ route('cart.decrease', $product->product->id) }}" method="POST" style="margin-right: 10px;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">-</button>
                                        </form>
                                        {{ $product->count }}
                                        <form action="{{ route('cart.increase', $product->product->id) }}" method="POST" style="margin-left: 10px;">
                                            @csrf
                                            <button type="submit" class="btn btn-success">+</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- <div id="productModal-{{ $product->product->id}}" class="modal">
                                <div class="modal-content">
                                    <span class="close" onclick="closeProduct()">&times;</span>
                                    <div id="modalProduct">
                                        <h2 id="modal-cart-name">{{ $product->product->name }}</h2>
                                        <div id="modalProductInfo" style="display: flex;flex-direction: column;align-items: flex-start;">
                                            <img class="card-img-top" id="modal-cart-image" src="{{ $product->product->image }}" alt="{{ $product->product->name }}" style="height: 200px; object-fit: cover;">
                                            <p id="modal-cart-description" class="card-title">{{ $product->product->description }}</p>
                                            <p id="modal-cart-price" class="card-title">{{ $product->product->price }} ₽</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                        @else
                            <tr>
                                <td colspan="3">Товар недоступен</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                <p>Общая сумма: {{ $total }} ₽</p>
                <form action="{{ route('cart.checkout') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="address">Адрес доставки</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Купить</button>
                </form>
            @endif
        </div>
    </div>
</div>


<script src="{{ asset('js/modalProduct.js') }}"></script>
