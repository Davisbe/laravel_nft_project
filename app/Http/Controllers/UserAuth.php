<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuth extends Controller
{
    function login() {
        return view('login');
    }

    function register() {
        return view('sign_up');
    }

    function save(Request $request) {
        $request->validate([
            'name'=>'required|min:5|max:15',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|max:20',
            'password_confirm'=>'required|in:'.$request->password
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return redirect('auth/login')->with('success', 'Profile created! You can now log in.');
        }
        else {
            return back()->with('fail','Something went wrong, try again later');
        }
    }

    function check(Request $request) {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8|max:15'
        ]);

        $userinfo = User::where('email','=',$request->email)->first();
        $credentials = [
            'email' => $request->email,
            'password'=>$request->password
        ];

        if (!$userinfo){
            return back()->with('fail','User with provided email not found');
        } else{
            if (Hash::check($request->password, $userinfo->password) and Auth::attempt($credentials)) {
                $request->session()->put('LoggedUser', $userinfo->id);

                $userinfo->is_active = 1;
                $userinfo->save();

                return redirect('/');
            } else{
                return back()->with('fail', 'Incorrect password');
            }
        }
    }

    function logout() {
        if(session()->has('LoggedUser') and Auth::check()) {

            $user = User::where('id', Auth::user()->id)->firstOrFail();
            $user->is_active = 0;
            $user->save();

            Auth::logout();
            session()->pull('LoggedUser');
        }
        return redirect('auth/login');
    }
}
