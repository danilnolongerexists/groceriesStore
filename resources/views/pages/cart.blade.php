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
                            <th>Название товара</th>
                            <th>Цена</th>
                            <th>Количество</th>
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
                                <td><button id="openProductModalBtn">{{ $product->product->name }}</button></td>
                                <td>{{ $product->product->price * $product->count }}</td>
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
                        @else
                            <tr>
                                <td colspan="3">Товар недоступен</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>

                <div id="productModal" class="modal">
                    <div class="modal-content">
                        <span class="close" id="closeProduct">&times;</span>
                        <div id="modalProduct">
                            <h2>{{ $product->product->name }}</h2>
                            <div id="modalProductInfo" style="display: flex;flex-direction: column;align-items: flex-start;">
                                <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                <p class="card-title">{{ $product->product->description }}</p>
                                <p class="card-title">{{ $product->product->price }} ₽</p>
                            </div>
                        </div>
                    </div>
                </div>

                <p>Общая сумма: {{ $total }}</p>
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
