<?php

namespace App\Http\Controllers\Auth;

use App\Models\Status;
use App\Http\Controllers\Controller;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    protected $usuario;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        parent::__construct();
        $this->middleware('guest:web');
        $this->usuario = $usuarioRepository;
    }

    public function showRegistrationForm()
    {
        return view('site.auth.login');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'nome' => 'required|string|max:50',
            'sobrenome' => 'required|string|max:100',
            'email' => 'required|string|email|max:200|unique:usuarios,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * @return mixed
     */
    public function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\Models\Usuario
     */
    protected function create(array $data)
    {
        return $this->usuario->model()->create([
            'nome' => $data['nome'],
            'sobrenome' => $data['sobrenome'],
            'email' => $data['email'],
            'password' => $data['password'],
            'status_id' => Status::ATIVO,
        ]);
    }

    /**
     * The user has been registered.
     *
     * Criar evento para disparar email de boas vindas
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function registered($request, $user)
    {
        flash()->overlay("Seja muito bem vindo(a) {$request->nome}!", "Olá!");
        return redirect()->intended(route('site.index'));
    }

}
