<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginFormRequest;
use App\Http\Requests\Auth\SignupFormRequest;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    protected $users;
    public function __construct()
    {
        $this->users = new Users;
    }

    public function login()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Đăng nhập';
        return view('clients.auth.login', compact('title'));
    }

    public function signup()
    {
        \App\Helpers\Helper::showAlert();
        $title = 'Đăng ký';
        return view('clients.auth.signup', compact('title'));
    }

    public function postLogin(LoginFormRequest $request)
    {

        $username = $request->username; // lấy dữ liệu input
        $password = $request->password;
        $user = Users::where('username', $username)->first();
        // mật khẩu mã hóa $password == $user->password
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            Users::where('id', Auth::user()->id)->update([
                'ip' => $request->ip(), // update ip người dùng
            ]);
            return redirect(route('home'))->withSuccessMessage('Đăng nhập thành công');
        } else {
            return redirect(route('login'))->withErrorMessage('Tài khoản mật khẩu không chính xác!');
        }
    }
    public function postSignup(SignupFormRequest $request)
    {
        Users::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'ip' => $request->ip(),
        ]);
        return redirect(route('login'))->withSuccessMessage('Đăng ký tài khoản thành công!');
    }


}
