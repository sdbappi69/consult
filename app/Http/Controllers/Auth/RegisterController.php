<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Service;
use App\User;
use http\Env\Request;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'msisdn' => ['required','regex:^(?:\+?+88)?01[345-9]\d{8}$^'],
            'viber' => ['nullable','regex:^(?:\+?+88)?01[345-9]\d{8}$^'],
            'emo' => ['nullable','regex:^(?:\+?+88)?01[345-9]\d{8}$^'],
            'telegram' => ['nullable','regex:^(?:\+?+88)?01[345-9]\d{8}$^'],
            'whatsapp' => ['nullable','regex:^(?:\+?+88)?01[345-9]\d{8}$^'],
            'image' => ['nullable','mimes:jpg,png,jpeg,webp'],
            'service' => ['required','exists:services,id'],
            'birth_date' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create($data)
    {
        $image = null;
        if ($data->has('image')) {
            if ($data->file('image')) {
                $file = $data->file('image');
                $image = time() . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
                $img_upload_path = 'uploads/';
                $file->move($img_upload_path, $image);
            }
        }
        $service = Service::findOrfail($data->service);
        $user =  User::create([
            'name' => $data->name,
            'email' => $data->email,
            'mobile' => $data->msisdn,
            'status' => 0,
            'password' => Hash::make($data->password),
            'attributes' => json_encode([
                'image_url' => $image,
                'service_charge_percentage' => 0,
                'birth_date' => $data->birth_date,
                'profession' => $service->name,
                'service_id' => $data->service,
                'mediums' => json_encode([
                    'mobile' => $data->msisdn,
                    'viber' => $data->viber,
                    'skype' => $data->skype,
                    'whatsapp' => $data->whatsapp,
                    'emo' => $data->emo,
                    'telegram' => $data->telegram,
                ])
            ])
        ]);
        return $user;
    }
}
