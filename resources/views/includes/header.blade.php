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
    <div>
        <nav>
            <a href="{{ route('index') }}">Бригантина</a>
            <input type="text" placeholder="Найти товары...">
            <div>
                <ul>
                    @auth
                        <li>
                            <a href="{{ route('profile') }}">Профиль</a>
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
            <span class="close">&times;</span>

            <!-- Форма авторизации -->
            <div id="loginForm">
                <h2>Авторизация</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Введите почту" required name="user[email]">
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

    <script src="{{ asset('js/app.js') }}"></script>

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
