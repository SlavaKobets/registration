<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Country;
use App\Services\UsersService;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    */


    /**
     * Current work service
     */
    protected $service;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->service = new UsersService();
    }

    /**
     * Show the application registration form.
     *
     * @return View
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register',[
            'countries' => Country::query()->get()->transform(function ($country){
                return [
                  'country_name' => $country->flag . ' ' .$country->country_name,
                  'country_id'   => $country->id,
                  'code'         => $country->calling_code
                ];
            })
        ]);
    }

    /**
     * @param RegisterRequest $request
     * @return View
     */
    public function register(RegisterRequest $request): View
    {
        return view('result', [
            'result' => $this->service->registerUser(
                $request->input('name'),
                $request->input('email'),
                (int)$request->input('country'),
                $request->input('phone')
            )
        ]);
    }
}
