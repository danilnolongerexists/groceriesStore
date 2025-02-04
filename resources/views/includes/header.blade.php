<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <!-- resources/views/your-view.blade.php -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="header">
        <nav class="header-nav">
            <a href="{{ route('index') }}">Бригантина</a>
            <input type="text" placeholder="Найти товары...">
            <div>
                <ul>
                    @auth
                        <li>
                            <button id="openProfileModalBtn">Профиль</button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cart') }}">Корзина</a>
                        </li>
                    @else
                        <li>
                            <button id="openModalBtn">Войти</button>
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
                    <a class="nav-link" href="{{ route('logout') }}">Выход</a>
            </div>
            <div id="editProfileForm" style="display: none;">
                <h2>Редактировать профиль</h2>
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
                    @endauth
                    <div class="modal-footer">
                      <button type="submit">Сохранить изменения</button>
                    </div>
                  </form>
                <button id="cancelEditBtn">Отмена</button>
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
