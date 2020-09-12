<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password;

class CreateNewUser implements CreatesNewUsers
{
    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        file_put_contents ('check.txt', 'nafes');
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
			'last_name' => ['required', 'string', 'max:255'],
			'country' => ['required', 'string', 'max:255'],
			'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', new Password, 'confirmed'],
        ])->validate(); 

        return User::create([
            'first_name' => $input['firstName'],
			'last_name' => $input['lastName'],
			'country' => $input['country'],
            'email' => $input['email'],
			'phone' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
