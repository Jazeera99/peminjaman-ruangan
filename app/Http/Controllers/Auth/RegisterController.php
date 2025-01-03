<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:20', 'unique:users'], // Validasi unik untuk NPM
            'prodi' => ['required', 'string'],
            'semester' => ['required', 'integer', 'min:1', 'max:8'], // Validasi angka untuk semester
            'no_telp' => ['required', 'string', 'max:15'], // Validasi untuk nomor telepon
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // Validasi file foto
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Simpan foto ke folder storage/app/public/fotos
        $fotoPath = $data['foto']->store('fotos', 'public');

        return User::create([
            'name' => $data['name'],
            'npm' => $data['npm'],
            'prodi' => $data['prodi'],
            'semester' => $data['semester'],
            'no_telp' => $data['no_telp'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user', // Default role sebagai user
            'foto' => $fotoPath, // Simpan path foto
        ]);
    }
}
