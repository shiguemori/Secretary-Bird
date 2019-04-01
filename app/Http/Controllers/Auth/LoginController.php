<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AutenticarContaRequest;
use App\Models\Status;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest:web')->except('logout');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('site.' . env('SITE_THEME', 'default') . '.auth.login');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(AutenticarContaRequest $autenticar)
    {
        if (Auth::guard('web')->attempt([
            'email' => $autenticar->email,
            'password' => $autenticar->password,
            'status_id' => Status::ATIVO,
        ])) {
            return redirect()->intended(route('site.index'));
        }
        flash('Login ou senha inválidos')->important();
        return redirect()->back();
    }

    public function logout()
    {
        flash()->overlay('Espero você de volta em breve!', "Até mais " . Auth::guard('web')->user()->nome);
        Auth::guard('web')->logout();
        return redirect()->route('site.login');
    }
}
