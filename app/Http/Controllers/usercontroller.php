<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usercontroller extends Controller
{ 
    public function checklogin(Request $r){
        $user = $r->user;
        $pwd  = $r->pwd;

        $accounts = [
            'kheang@gmail.com' => ['password' => '1234', 'role' => 'admin'],
            'momo@gmail.com'   => ['password' => '1234', 'role' => 'user'],
        ];

        if (isset($accounts[$user]) && $accounts[$user]['password'] === $pwd) {
            session(['user' => $user, 'role' => $accounts[$user]['role']]);
            return $accounts[$user]['role'] === 'admin'
                ? redirect('/admin')->with('success', 'Welcome back, Admin!')
                : redirect('/')->with('success', 'Welcome back!');
        }

        return redirect('user/login')->with('error', 'Invalid email or password.');
    }
}
