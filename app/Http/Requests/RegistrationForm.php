<?php

namespace App\Http\Requests;

use App\User;
use App\Mail\WelcomeAgain;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationForm extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8|confirmed'
        ];
    }

    public function persist()
    {
        // create and save the user
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        // sing user in
        auth()->login($user);

        // mail the user the welcome letter
        Mail::to($user)->send(new WelcomeAgain($user));
    }
    
}
