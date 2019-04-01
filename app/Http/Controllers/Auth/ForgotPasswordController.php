<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecuperarContaRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web');
    }

    /**
     * @return mixed
     */
    protected function broker()
    {
        return Password::broker('users');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('site.' . env('SITE_THEME', 'default') . '.auth.email');
    }

    /**
     * @param RecuperarContaRequest $recuperarConta
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function sendResetLinkEmail(RecuperarContaRequest $recuperarConta)
    {
        $broker = $this->broker()->sendResetLink($recuperarConta->only('email'));

        if ($broker == Password::RESET_LINK_SENT) {
            flash('Verifique sua caixa de e-mail!')->success()->important();
            return redirect()->back();
        }
        return back()
            ->withInput($recuperarConta->only('email'))
            ->withErrors(['email' => trans($broker)]);
    }
}
