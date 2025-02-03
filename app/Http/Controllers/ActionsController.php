<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Cart;

class ActionsController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'user.name' => 'required',
            'user.email'=> 'required|email',
            'user.phone' => 'required|phone:ru|unique:users,phone', // Новое правило для телефона
            'user.password' => 'required|min:8|alpha_dash|confirmed',
        ], [
            'user.name.required' => 'Поле "Имя" обязательно для заполнения',
            'user.email.reqired' => 'Поле "Электронная почта" обязательно для заполнения',
            'user.email.email'=> 'Поле "Электронная почта" должно быть предоставлено в виде валидного адреса электронной почты',
            'user.phone.required' => 'Поле "Телефон" обязательно для заполнения',
            'user.phone.phone' => 'Номер телефона должен быть в формате +7 999 999 99 99',
            'user.phone.unique' => 'Данный номер телефона уже зарегистрирован',
            'user.password.required'=> 'Поле "Пароль" обязательно для заполнения',
            'user.password.min'=> 'Поле "Пароль" должно быть не менее, чем 8 символов',
            'user.password.alpha_dash'=> 'Поле "Пароль" должно содержать только строчные и прописные символы латиницы, цифры, а также символы "-" и "_"',
            'user.password.confirmed'=> 'Поле "Пароль" и "Повторите пароль" не совпадает',
        ]);

        // Форматируем телефон для записи в БД (без пробелов)
        $cleanPhone = $this->cleanPhoneNumber($request->input('user.phone'));

        $user = User::create([
            'name' => $request->input('user.name'),
            'email' => $request->input('user.email'),
            'phone' => $cleanPhone,
            'password' => bcrypt($request->input('user.password')),
        ]);

        Auth::login($user);
        return redirect('/');

        // $user = User::create($request -> input('user'));
        // Auth::login($user);
        // return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function login(Request $request)
    {
        $request->validate([
            // 'user.email'=> 'required|email',
            'user.phone' => 'required|phone:ru', // Валидация телефона
            'user.password'=> 'required|min:8|alpha_dash',
        ], [
            // 'user.email.reqired' => 'Поле "Электронная почта" обязательно для заполнения',
            // 'user.email.email'=> 'Поле "Электронная почта" должно быть предоставлено в виде валидного адреса электронной почты',
            'user.phone.required' => 'Поле "Телефон" обязательно для заполнения',
            'user.phone.phone' => 'Номер телефона должен быть в формате +7 999 999 99 99',
            'user.password.required'=> 'Поле "Пароль" обязательно для заполнения',
            'user.password.min'=> 'Поле "Пароль" должно быть не менее, чем 8 символов',
            'user.password.alpha_dash'=> 'Поле "Пароль" должно содержать только строчные и прописные символы латиницы, цифры, а также символы "-" и "_"',
        ]);

        // Очищаем телефон перед проверкой
        $cleanPhone = $this->cleanPhoneNumber($request->input('user.phone'));

        if(Auth::attempt(['phone' => $cleanPhone, 'password' => $request->input('user.password')])) {
            return redirect('/');
        } else {
            return back()->withErrors([
                'user.phone' => 'Предоставленный номер телефона или пароль не подходят'
            ]);
        }
    }

    public function profile_update(Request $request)
    {
        $user = Auth::user();

    // Валидация данных
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'phone' => 'required|phone:ru|unique:users,phone,' . $user->id,
        'password' => 'nullable|string|min:8',
        'address'=> 'nullable|string|max:255'
    ]);

    // Очистка и форматирование номера телефона
    $cleanPhone = $this->cleanPhoneNumber($request->input('phone'));

    // Обновление данных пользователя
    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone = $cleanPhone; // Используем отформатированный номер
    $user->address = $request->address;

    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('index')->with('success', 'Профиль успешно обновлен');
    }

        /**
     * Очищает номер телефона от всех нечисловых символов и добавляет код страны.
     *
     * @param string $phone
     * @return string
     */
    private function cleanPhoneNumber($phone)
    {
        // Удаляем все нецифровые символы
        $digits = preg_replace('/[^0-9]/', '', $phone);

        // Добавляем код страны если его нет
        if (strlen($digits) == 10 && substr($digits, 0, 1) == '9') {
            $digits = '7' . $digits;
        }

        return '+' . $digits; // Возвращаем номер без пробелов
    }
}
