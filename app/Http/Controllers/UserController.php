<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginValidation;
use App\Http\Requests\RegisterValidation;
use App\Http\Requests\User\NewUserValidation;
use App\Http\Requests\User\UserUpdateValidation;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Вызов шабона авторизации пользователя
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login (){
        return view('users.login');
    }

    /**
     * Авторизация пользователя
     *
     * @param LoginValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginPost (LoginValidation $request){
        if (Auth::attempt($request->validated())){
            $request->session()->regenerate();
            return back()->with(['success' => 'true']);
        }
        return back() -> withErrors(['auth' => 'Логин или пароль не верный!']);
    }

    /**
     * Вызов шаблона регистрации пользователя
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register (){
        return view('users.register');
    }

    /**
     * Регистрация пользователя
     *
     * @param RegisterValidation $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerPost (RegisterValidation $request, Role $role){
        $requests = $request->validated();
        $requests['password'] = Hash::make($requests['password']);
        unset($requests['photo_file']);
        # public/sdfsdfsdfsd.jpg
        $photo = $request->file('photo_file')->store('public');
        # Explode => / => public/sdfsdfsdfsd.jpg => ['public', 'sdfsdfsdfsd.jpg']
        $requests['photo'] = explode('/',$photo)[1];
        User::create($requests);
        return redirect()->route('login')->with(['register' => 'true']);
    }

    /**
     * Выход пользователя с аккаунта
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request){
        Auth::logout();
        $request->session()->regenerate();
        return redirect()->route('login');
    }

    /**
     * Вывод всех пользователей
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.users', compact('users'));
    }

    /**
     * Вызов шаблона редактирования пользователя
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Request $request, User $user)
    {
        $roles = Role::all();
        $request->session()->flashInput($user->toArray());
        return view('admin.user.createOrUpdate', compact('user' , 'roles'));
    }

    /**
     * Редактирование пользователя
     *
     * @param UserUpdateValidation $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateValidation $request, User $user)
    {
        $validate = $request->validated();
        $user->update($validate);
        return back()->with(['success' => true]);
    }

    /**
     * Удаление пользователя
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with(['success' => true]);
    }

    /**
     * Вызов шаблона регистрации пользователя(для админа)
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.user.newRegister', compact('roles'));
    }

    /**
     * Регистрация пользователя(для админа)
     *
     * @param NewUserValidation $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewUserValidation $request)
    {
        $requests = $request->validated();
        unset($requests['photo_file']);
        # public/asd.jpg
        $photo = $request->file('photo_file')->store('public');
        # Explode => / => public/asd,jpg => ['public', 'asd.jpg']
        $requests['photo'] = explode('/', $photo)[1];
        $requests['password'] = Hash::make($requests['password']);
        User::create($requests);
        return back()->with(['register' => true]);
    }

    /**
     * Вывод одного пользователя(более расширенного информацией)
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }
}
