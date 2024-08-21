<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use function Laravel\Prompts\password;

class AuthController extends Controller
{

    public function create()
    {
        return view('register_index');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|min:3',
            'email' => 'required|string|email:dns|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        Auth::login($user);

        $randomNumber = rand(1000, 9999);
        Session::put('randomNumber', $randomNumber);
        try {
            Session::put('userId', $user->id);

            Mail::send('emails_test', ['randomNumber' => $randomNumber], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your Verification Code');
            });
            return redirect()->route('category.index')->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'There was an error sending the email.']);
        }
    }

    public function verify()
    {
        return view('verify');
    }
    public function emailVerification(Request $request)
    {
        $randomNumber = Session::get('randomNumber');
        $enteredCode = $request->input('reset_code');
        $userId = Auth::id();

        if ($enteredCode != $randomNumber) {
            return back()->withErrors(['reset_code' => 'The reset code is incorrect.']);
        }
        if (!$userId) {
            return back()->withErrors(['email' => 'User not found.']);
        }
        $user = Auth::user();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $user->update([
            'email_verified_at' => now(),
        ]);

        Session::forget('randomNumber');
        return redirect()->route('category.index')->with('success', 'Email verified successfully!');
    }

    public function logindex()
    {
        return view('login');
    }

    public function login(Request $request){
        $validatedData = $request->validate([
            'email' => 'required|string|email:dns|max:255',
            'password' => 'required|string|min:8',
        ]);

        if(Auth::attempt($request->only('email', 'password')))
            return redirect()->route('category.index');

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out.');
    }

    public function forgotPasswordIndex(Request $request)
    {
        return view('forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $email = $request->input('email');
        $randomNumber = rand(1000, 9999);
        Session::put('randomNumber', $randomNumber);
        try {
            $user = User::where('email', $email)->firstOrFail();
            Session::put('user', $user);

            Mail::send('emails_test', ['randomNumber' => $randomNumber], function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Your Verification Code');
            });
            return redirect()->route('password.match')->with('success', 'Email sent successfully!');
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
            return back()->withErrors(['email' => 'There was an error sending the email.']);
        }
    }

    public function match()
    {
        return view('password_match');
    }

    public function matchete(Request $request){
        $request->validate([
            'reset_code' => 'required|string|min:4|max:4',
            'password' => 'required|confirmed|min:8',
        ]);

        $randomNumber = Session::get('randomNumber');
        $enteredCode = $request->input('reset_code');
        $user = Session::get('user');

        if ($enteredCode != $randomNumber) {
            return back()->withErrors(['reset_code' => 'The reset code is incorrect.']);
        }

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        Session::forget('randomNumber');
        return redirect()->route('logindex')->with('success', 'Password reset successfully!');
    }
}
