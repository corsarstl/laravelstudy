<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(RegistrationForm $form)
    {
        // validate the form
        // the simple way
//        $this->validate(request(), [
//            'name' => 'required|unique:users',
//            'email' => 'required|unique:users|email',
//            'password' => 'required|min:8|confirmed'
//        ]);
        $form->persist();

        session()->flash('message', 'Thanks so much for signing up');

        // redirect to the home page
        return redirect()->home();
    }
}
