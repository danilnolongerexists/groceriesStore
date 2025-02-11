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
                                                    {{ $product->product->name }}
                                        </a>
                                    </td>
                                    <td>{{ $product->product->price * $product->count }} ₽</td>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            <form action="{{ route('cart.decrease', $product->product->id) }}" method="POST" style="margin-right: 10px;">
                                                @csrf
                                                <button type="submit" class="btn-cart">-</button>
                                            </form>
                                            {{ $product->count }}
                                            <form action="{{ route('cart.increase', $product->product->id) }}" method="POST" style="margin-left: 10px;">
                                                @csrf
                                                <button type="submit" class="btn-cart">+</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div id="productModal-{{ $product->product->id}}" class="modal">
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
