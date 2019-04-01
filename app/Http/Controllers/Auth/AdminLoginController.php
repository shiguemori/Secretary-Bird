<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutenticarContaRequest;
use App\Models\Status;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * @param AutenticarContaRequest $autenticar
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(AutenticarContaRequest $autenticar)
    {
        if (Auth::guard('admin')->attempt([
            'email' => $autenticar->email,
            'password' => $autenticar->password,
            'status_id' => Status::ATIVO,
        ])) {
            return redirect()->intended(route('admin.dashboard'));
        }
        flash('Credenciais inválidas')->important();
        return redirect()->back()->withInput($autenticar->only('email'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        flash('Espero você de volta logo mais!')->success();
        return redirect()->route('noacl.route.login');
    }

}
