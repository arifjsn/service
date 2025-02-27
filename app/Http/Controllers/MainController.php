<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMailer;
use App\Mail\ForgotPasswordMailer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class MainController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Registrasi
     * @param {Object} $request
     */
    public function registerAction(Request $request)
    {
        // Validasi
        $rules = [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:75|unique:users,email',
            'password' => [
                'required',
                'string',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            ],
            'confirm_password' => 'required|same:password'
        ];
        $request->validate($rules);

        // Menggunakan fungsi waktu untuk menghasilkan string acak dan sha256 adalah algoritma hashing
        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = $token;
        $user->save();

        $user->assignRole('User');

        $verificationLink = url('/verify/' . $token . '/' . $request->email . '/');
        $mailSubject = 'Registration Verification Link';
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'link' => $verificationLink,
            'brand' => ''
        ];
        Mail::to($request->email)->send(new RegisterMailer($mailSubject, $userData));

        return redirect()->route('login')->with('success', "Registration successful. A verification Email will be sent to your email address (check spam email if it doesn't appear)");
    }

    /**
     * Verifikasi Akun
     * @param {String} $token
     * @param {String} $email
     */
    public function verifyAccount($token, $email)
    {
        // untuk mengosongkan token dan memperbarui status sebagai aktif
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            dd('user not found or invalid token');
        } else {
            $user->token = NULL; // menghapus token karena sudah aktif
            $user->status = 'active';
            $user->update();
        }

        return redirect()->route('login')->with('success', 'Your account has been activated, please login.');
    }

    public function login()
    {
        return view('auth.login');
    }

    /**
     * Login
     * @param {Object} $request
     */
    public function loginAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        try {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            $userExist = User::whereEmail($request->email)->exists();
            if (!$userExist) {
                return redirect()->back()->with('error', 'Email address has not been registered.');
            }

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->status == 'active') {
                    return redirect()->route('dashboard');
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'Email address has not been verified. Please check your inbox for a verification email or use the Resend Verification Feature below if the email is not sent.');
                }
            } else {
                return redirect()->back()->with('error', 'Login Failed. Please check your Email & Password.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function reVerify()
    {
        return view('auth.reverify');
    }

    public function reVerifyAction(Request $request)
    {
        $user = User::whereEmail($request->email)->first();
        if (!User::whereEmail($request->email)->exists()) {
            return redirect()->back()->with('error', 'Email address has not been registered.');
        }
        $verificationLink = url('/verify/' . $user->token . '/' . $user->email . '/');
        $mailSubject = 'Registration Verification Link';
        $userData = [
            'name' => $user->name,
            'email' => $user->email,
            'link' => $verificationLink,
            'brand' => ''
        ];
        Mail::to($user->email)->send(new RegisterMailer($mailSubject, $userData));

        return redirect()->route('login')->with('success', "A verification Email will be sent to your email address (check spam email if it doesn't appear)");
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordAction(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        try {
            $user = User::whereEmail($request->email)->first();
            if (!User::whereEmail($request->email)->exists()) {
                return redirect()->back()->with('error', 'Email address has not been registered.');
            }
            if ($user->status !== 'active') {
                return redirect()->back()->with('error', 'Email address has not been activated.');
            }
            $token = hash('sha256', time());
            $user->token = $token;
            $user->save();

            $newPasswordLink = url('/new-password/' . $token . '/' . $request->email . '/');
            $mailSubject = 'Set Up New Password';
            $userData = [
                'email' => $request->email,
                'link' => $newPasswordLink,
                'brand' => ''
            ];
            Mail::to($request->email)->send(new ForgotPasswordMailer($mailSubject, $userData));

            return redirect()->route('login')->with('success', "An Email for Set Up New Password will be sent to your email address.");
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function newPassword()
    {
        return view('auth.new-password');
    }

    public function newPasswordAction(Request $request)
    {
        $request->validate([
            'password' =>  [
                'required',
                'string',
                Password::min(8)->letters()->numbers()->mixedCase()->symbols()
            ]
        ]);

        try {
            $user = User::whereEmail($request->email)->first();
            $user->token = '';
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('login')->with('success', "Password has been changed.");
        } catch (\Throwable $th) {
            session()->flash('error', $th->getMessage());
            return redirect()->back();
        }
    }

    public function logout()
    {
        try {
            Auth::guard('web')->logout();

            return redirect()->route('login');
        } catch (\Throwable $th) {
        }
    }

    public function dashboard()
    {
        $user = Auth::user();

        return view('dashboard', [
            'user' => $user
        ]);
    }
}
