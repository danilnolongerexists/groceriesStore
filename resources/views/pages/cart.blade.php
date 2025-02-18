@include('includes.header')
    <div class="cart">
            <h1>Корзина</h1>
            {{-- <p>Добро пожаловать на страницу вашей корзины, {{ Auth::user()->name }}!</p> --}}
            @if($products->isEmpty())
                <p>Ваша корзина пуста.</p>
            @else
                <div class="cart-wrap">
                    <table class="table">
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
                                    <td class="cart-product">
                                        <a id="openProductModalBtn" onclick="setproducttemp({{ json_encode($product->product->id) }})">
                                            <img id="modal-cart-image" src="{{ $product->product->image }}" alt="{{ $product->product->name }}">
                                            <div class="cart-product-info">
                                                <p class="product-name-cart">{{ $product->product->name }}</p>
                                                <p class="product-price-cart">{{ $product->product->price * $product->count }} ₽</p>
                                            </div>
                                        </a>
                                        <div class="cart-count-wrap">
                                            <form action="{{ route('cart.decrease', $product->product->id) }}" method="POST" style="margin-right: 10px;">
                                                @csrf
                                                <button type="submit" class="btn-cart">-</button>
                                            </form>
                                            <p class="product-price-cart">{{ $product->count }}</p>
                                            <form action="{{ route('cart.increase', $product->product->id) }}" method="POST" style="margin-left: 10px;">
                                                @csrf
                                                <button type="submit" class="btn-cart">+</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td class="cart-count">

                                    </td>
                                </tr>

                                <div id="productModal-{{ $product->product->id}}" class="modal">
                                    <div class="modal-content" id="modal-content">
                                        <span class="close" id="closeProduct" onclick="closeProduct()">&times;</span>
                                        <div id="modalProduct">
                                            <div id="modalProductInfo">
                                                <img src="{{ $product->product->image }}" alt="{{ $product->product->name }}">
                                                <div class="modalProductText">
                                                    <h2>{{ $product->product->name }}</h2>
                                                    <p>{{ $product->product->description }}</p>
                                                    <p><b>{{ $product->product->price }} ₽</b> за штуку</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @else
                                <tr>
                                    <td colspan="3">Товар недоступен</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                    <div class="cart-total">
                        <table class="cart-total-table">
                            <tbody>
                                <tr>
                                    <td><p><b>Итого</b></p></td>
                                    <td><p><b> {{ $total }} ₽</b></p></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <div class="input-group">
                                <input type="text" class="input" id="address" placeholder="" name="address" value="{{ Auth::user()->address }}" required>
                                <label class="label" for="address">Адрес доставки</label>
                            </div>
                            <button type="submit">Оформить заказ</button>
                        </form>
                    </div>
                </div>
            @endif
        @include('includes.footer')
    </div>
<script src="{{ asset('js/modalProduct.js') }}"></script>
