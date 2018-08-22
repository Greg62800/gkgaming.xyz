<?php

namespace App\Http\Controllers;

use App\Notifications\Login;
use App\Notifications\Logout;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Notification;
use Validator;


class UsersController extends Controller {

    protected $auth;

    /**
     * @param Guard $auth
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * @return mixed
     */
    public function index()
    {
        $user = Auth::user();
        return view('users.profil', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function register() {
        if($this->auth->check()) {
            return redirect('/')->with('success', "Déjà connecté !");
        }
        return view('users.register');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $user = new User();

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        User::create($request->all());
        return redirect(route('users.login'))->with('success', "Inscription terminées.");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function login() {
        if($this->auth->check()) {
            return redirect('/')->with('success', "Déjà connecté !");
        }
        return view('users.login');
    }

    /**
     * @param Request $request
     * @param Guard $auth
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login_in(Request $request, Guard $auth) {

        if(filter_var($request->get('name'), FILTER_VALIDATE_EMAIL)) {
            $name = 'email';
        }else {
            $name = 'name';
        }

        if(Auth::attempt([$name => request()->get('name'), 'password' => request()->get('password')])) {
            return redirect('/')->with('success', 'Connecté');
        }else {
            return back()->with('error', "Nom d'utilisateur ou mot de passe incorrect.");
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit() {
        if(!$this->auth->check()) {
            return redirect('/')->with('success', "Vous devez vous connecter pour accéder a cette page");
        }
        $user = User::where('id', Auth::user()->id)->first();
        return view('users.edit', ['user' => $user]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $file = request()->file('avatar');

        $validator = Validator::make(request()->all(), [
            'email' => 'required'
        ]);


        if($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with('error', "Oups certains champs sont vides");
        }
        if(isset($file) && $file->isValid()) {
            $destination_path = public_path() . '/img/avatars';
            $avatar = Auth::user()->id . '.png';
            $file->move($destination_path, $avatar);
            $user->avatar = $avatar;
            $user->update();
        }

        $user->update($request->all());
        return redirect(route('users.edit'))->with('success', "Votre compte à bien été mis à jour");
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function avatar() {
        if(!$this->auth->check()) {
            return redirect('/')->with('success', "Vous devez vous connecter pour accéder a cette page");
        }
        $user = User::where('id', Auth::user()->id)->first();
        return view('users.avatar', ['user' => $user]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add_avatar(Request $request) {
        $file = request()->file('avatar');
        $user = User::where('id', Auth::user()->id)->first();

        $validator = Validator::make($request->all(), [
            'avatar' => 'required'
        ]);

        if($validator->fails()) {
            return redirect(route('users.add_avatar'))->with('error', "Votre image n'est pas valide");
        }else {
            if($file->isValid()) {
                $destination_path = public_path() . '/img/avatars';
                $avatar = Auth::user()->id . '.png';
                $file->move($destination_path, $avatar);
                $user->avatar = $avatar;
                $user->update();
                return redirect(route('users.add_avatar'))->with('success', "Votre avatar a bien été uploadé");
            }
        }
    }

    public function avatar_delete() {
        if(!$this->auth->check()) {
            return redirect('/')->with('success', "Vous devez vous connecter pour accéder a cette page");
        }
        $avatar = public_path() . '/img/avatars/' . Auth::user()->id . '.png';
        if(\File::exists($avatar)) {
            \File::delete($avatar);
        }
        $user = User::where('id', Auth::user()->id)->first();
        $user->avatar = '';
        $user->update();
        return redirect()->route('users.edit')->with('success', "Votre avatar a bien été supprimé");
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout() {
        Auth::logout();
        return redirect('/')->with('success', "Déconnecté !");
    }

    public function fail() {
        return back()->with('error', 'Impossible de supprimer votre avatar');
    }
}