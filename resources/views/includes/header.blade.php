<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <!-- resources/views/your-view.blade.php -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dela+Gothic+One&display=swap" rel="stylesheet">
</head>
<header>
    <div>
        <nav class="header-nav">
            <div class="logo-brand">
                <a class="logo" href="{{ route('index') }}">БРИГАНТИНА</a>
            </div>
            {{-- <div class="text-field__icon">
                <input class="text-field__input" type="search" name="find" id="find" placeholder="css" value="html уроки">
                <span class="text-field__aicon-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path
                      d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg>
                </span>
              </div> --}}
            <div class="header-search">
                <form action="{{ route('search') }}" method="GET" class="d-flex">
                    <input class="input-search" type="text" name="query" placeholder="Искать продукты...">
                    <button type="submit" class="button-search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path
                              d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </form>
            </div>

            <div>
                <ul>
                    @auth
                        <li>
                            <a class="nav-link" href="{{ route('cart') }}">
                                <button class="nav-button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M21.822 7.431A1 1 0 0 0 21 7H7.333L6.179 4.23A1.994 1.994 0 0 0 4.333 3H2v2h2.333l4.744 11.385A1 1 0 0 0 10 17h8c.417 0 .79-.259.937-.648l3-8a1 1 0 0 0-.115-.921zM17.307 15h-6.64l-2.5-6h11.39l-2.25 6z"></path><circle cx="10.5" cy="19.5" r="1.5"></circle><circle cx="17.5" cy="19.5" r="1.5"></circle></svg>
                                Корзина
                                </button>
                            </a>
                        </li>
                        <li>
                            <button class="nav-button" id="openProfileModalBtn"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M12 2A10.13 10.13 0 0 0 2 12a10 10 0 0 0 4 7.92V20h.1a9.7 9.7 0 0 0 11.8 0h.1v-.08A10 10 0 0 0 22 12 10.13 10.13 0 0 0 12 2zM8.07 18.93A3 3 0 0 1 11 16.57h2a3 3 0 0 1 2.93 2.36 7.75 7.75 0 0 1-7.86 0zm9.54-1.29A5 5 0 0 0 13 14.57h-2a5 5 0 0 0-4.61 3.07A8 8 0 0 1 4 12a8.1 8.1 0 0 1 8-8 8.1 8.1 0 0 1 8 8 8 8 0 0 1-2.39 5.64z"></path><path d="M12 6a3.91 3.91 0 0 0-4 4 3.91 3.91 0 0 0 4 4 3.91 3.91 0 0 0 4-4 3.91 3.91 0 0 0-4-4zm0 6a1.91 1.91 0 0 1-2-2 1.91 1.91 0 0 1 2-2 1.91 1.91 0 0 1 2 2 1.91 1.91 0 0 1-2 2z"></path></svg>Профиль</button>
                        </li>
                    @else
                        <li>
                            <button class="nav-button" id="openModalBtn">Войти</button>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close">&times;</span>

            <!-- Форма авторизации -->
            <div id="loginForm">
                <h2>Авторизация</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <input type="phone" class="form-control" id="phone-log" placeholder="Введите номер телефона" required name="user[phone]">
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" placeholder="Введите пароль" required name="user[password]">
                    </div>

                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
                <p>Нет аккаунта? <a href="#" id="switchToRegister">Зарегистрироваться</a></p>
            </div>

            <!-- Форма регистрации -->
            <div id="registerForm" style="display: none;">
                <h2>Регистрация</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name">Имя</label>
                        <input type="text" class="form-control" id="name" placeholder="Введите имя" required name="user[name]">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Введите почту" required name="user[email]">
                    </div>

                    <div class="form-group">
                        <label for="phone">Номер телефона</label>
                        <input type="phone" class="form-control" id="phone-reg" placeholder="Введите номер телефона" required name="user[phone]">
                    </div>

                    <div class="form-group">
                        <label for="password">Пароль</label>
                        <input type="password" class="form-control" id="password" placeholder="Введите пароль" required name="user[password]">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Подтверждение пароля</label>
                        <input type="password" class="form-control" id="password_confirmation" placeholder="Повторите пароль" required name="user[password_confirmation]">
                    </div>

                    <button type="submit" class="btn btn-primary">Зарегистироваться</button>
                </form>
                <p>Уже есть аккаунт? <a href="#" id="switchToLogin">Войти</a></p>
            </div>
        </div>
    </div>

    <div id="profileModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeProfile">&times;</span>
            <div id="modalProfile">
                @auth
                    <h2>{{ Auth::user()->phone }}</h2>
                    <div id="modalProfileInfo" style="display: flex;flex-direction: column;align-items: flex-start;">
                        <p>{{ Auth::user()->name }}</p>
                        <p>{{ Auth::user()->email }}</p>
                        <p>{{ Auth::user()->address }}</p>
                    </div>
                    <button id="editProfileBtn">Редактировать профиль</button>
                    <button id="openOrdersBtn">Заказы</button>
                    <a class="nav-link" href="{{ route('logout') }}">Выйти из аккаунта</a>
                @endauth
            </div>
            <div id="editProfileForm" style="display: none;">
                <h2>Редактировать профиль</h2>
                @auth
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="phone">Номер телефона</label>
                            <input type="phone" class="form-control" id="phone-upd" placeholder="Введите номер телефона" name="phone" value="{{ Auth::user()->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <div class="form-group">
                            <label for="password">Пароль</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Введите новый пароль">
                        </div>
                        <div class="form-group">
                            <label for="address">Адрес</label>
                            <input type="address" class="form-control" id="address" name="address" placeholder="Введите новый адрес" value="{{ Auth::user()->address }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit">Сохранить изменения</button>
                    </div>
                  </form>
                @endauth

                <button id="cancelEditBtn">Отмена</button>
            </div>
            <div id="ordersProfile" style="display: none;">
                <button id="cancelOrdersBtn">Назад</button>
                <h2>
                    История заказов
                </h2>
                @auth
                    @foreach(Auth::user()->orders as $order)
                        <div class="card my-2">
                            <div class="card-body">
                                <h3 class="card-title">Заказ от {{ $order->created }}</h5>
                                <p class="card-text">Адрес доставки: {{ $order->address }}</p>
                                <p class="card-text">Товары:</p>
                                <ul>
                                    @foreach($order->products as $product)
                                        <li>
                                            <img class="card-img-top" src="{{ $product->image }}" alt="{{ $product->name }}" style="height: 70px; object-fit: cover;">
                                            {{ $product->name }}
                                            ({{ $product->pivot->count }} шт.)
                                        </li>
                                    @endforeach
                                </ul>
                                @if(empty($order->review))
                                    <form action="{{ route('orders.review', $order->id) }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="comment">Оставьте отзыв:</label>
                                            <textarea class="form-control" id="comment" name="comment"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Оценка:</label>
                                            <div>
                                                @for($i = 1; $i <= 5; $i++)
                                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }}>
                                                    <label for="star{{ $i }}">{{ $i }}</label>
                                                @endfor
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Отправить отзыв</button>
                                    </form>
                                @else
                                    <p>Ваш отзыв: {{ $order->review->comment }}</p>
                                    <p>Ваша оценка: {{ $order->review->rating }} из 5</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endauth
            </div>
        </div>
    </div>

<script src="https://unpkg.com/imask"></script>
<script src="{{ asset('js/phone.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/modalProfile.js') }}"></script>

@if($errors -> any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors -> all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</header>
