<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecuperarContaRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;

class AdminForgotPasswordController extends Controller
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
        parent::__construct();
        $this->middleware('guest:admin');
    }

    /**
     * @return mixed
     */
    protected function broker()
    {
        return Password::broker('admins');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    /**
     * @param RecuperarContaRequest $recuperarConta
     * @return \Illuminate\Http\RedirectResponse
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
