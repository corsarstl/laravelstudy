<?php

namespace App\Http\Controllers;

use App\Mail\Welcome;
use App\User;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        // validate the form
        $this->validate(request(), [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8|confirmed',
        ]);

        // create and save the user
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        // sing user in
        auth()->login($user);

        \Mail::to($user)->send(new Welcome($user));

        // redirect to the home page
        return redirect()->home();
    }
}
