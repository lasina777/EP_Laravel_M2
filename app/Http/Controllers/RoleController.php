<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\Role\RoleCreateValidation;
use App\Http\Requests\Admin\Role\RoleUpdateValidation;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;

class RoleController extends Controller
{
    /**
     * Вывод всех ролей
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.role.roles', compact('roles'));
    }

    /**
     * Вызов шаблона создания роли
     *
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->flashInput([]);
        return view('admin.role.createOrUpdate');
    }

    /**
     * Создание роли
     *
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(RoleCreateValidation $request)
    {
        $validate = $request->validated();
        Role::create($validate);
        return back()->with(['success' => true]);
    }

    /**
     * @param Role $role
     * @return void
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Вызов шаблона редактирования роли
     *
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Request $request, Role $role)
    {
        $request->session()->flashInput($role->toArray());
        return view('admin.role.createOrUpdate', compact('role'));
    }

    /**
     * Редактирование роли
     *
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function update(RoleUpdateValidation $request, Role $role)
    {
        $validate = $request->validated();
        $role->update($validate);
        return back()->with(['success' => true]);
    }

    /**
     * Удаление роли
     *
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return back()->with(['delete' => true]);
    }
}
