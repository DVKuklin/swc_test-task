<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function registerPage() {
        return view('register');
    }

    public function register(Request $request) {
        if (Auth::user()) {
            return redirect()->route('home');
        }

        $user_data = $request->validate([
            'login' => [
                            'required',
                            'unique:App\Models\User,login'
                        ],
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',
            'name' => 'required',
            'surname' => 'required',
            'birthday' => 'nullable|date',
        ], [
            'login.required' => 'Поле логин является обязательным',
            'login.unique' => 'Пользователь с таким логином уже существует',
            'password.required' => 'Поле Пароль является обязательным',
            'password.confirmed' => 'Пароли не совпадают',
            'password_confirmation.required' => 'Поле Подтверждение пароля является обязательным',
            'name.required' => 'Поле Имя является обязательным',
            'surname.required' => 'Поле Фамилия является обязательным',
            'birthday.date' => 'Поле день рождения должно быть датой',
        ]);

        try{
            User::create([
                'login' => $user_data['login'],
                'password' => Hash::make($user_data['password']),
                'name' => $user_data['name'], 
                'surname' => $user_data['surname'],
                'birthday' => $user_data['birthday'],
            ]);
    
            if (Auth::attempt($user_data)) {
                $request->session()->regenerate();
    
                return redirect()->route('home')->with('success', 'Вы успешно зарегистрировались на сайте.');
            }

            return redirect()->route('login')->withErrors(['Что то пошло не так.','Ваши данные в базу записались, но авторизоваться Вы не смогли.','Попробуйте просто авторизоваться.']);

        }catch(\Exception $e){
            return redirect()->route('register')->withErrors(['Что то пошло не так, попробуй ещё раз.']);
        }
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Вы успешно вышли из приложения.');
    }

    public function loginPage() {
        return view('login');
    }

    public function login(Request $request) {
        if (Auth::user()) {
            return redirect()->route('home');
        }

        $user_data = $request->validate([
            'login' => ['required'],
            'password' => ['required']
        ], [
            'login.required' => 'Поле логин является обязательным',
            'password.required' => 'Поле пароль является обязательным',
        ]);

        if (Auth::attempt($user_data)) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('success', 'Вы успешно вошли на сайт.');
        }

        return redirect()->route('login')->withErrors(['Логин или пароль не верные.']);
    }
}
