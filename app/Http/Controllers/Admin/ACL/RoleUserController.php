<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected $user, $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;

        $this->middleware(['can:users']);
    }

    public function roles($idUser)
    {
        $user = $this->user->find($idUser);
        if (!$user) {
            return redirect()->back()->with('danger', 'O código do usuário informado não consta em nossa base de dados!');
        }
        $title = "Cargos do Usuário |{$user->name}|";
        $roles = $user->roles()->orderBy('name')->paginate();
        return view('admin.pages.users.roles.roles', compact('user', 'roles', 'title'));
    }


    public function users($idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back();
        }
        $title = "Usuários do Cargo |{$role->name}|";
        $users = $role->users()->orderBy()->paginate();
        return view('admin.pages.roles.users.users', compact('role', 'users', 'title'));
    }


    public function rolesAvailable(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back()->with('danger', 'O código do usuário informado não consta em nossa base de dados!');
        }
        $title = "Cargos Disponíveis ao Usuário |{$user->name}|";
        $filters = $request->except('_token');
        $roles = $user->rolesAvailable($request->filter);
        return view('admin.pages.users.roles.available', compact('user', 'roles', 'filters', 'title'));
    }


    public function attachRolesUser(Request $request, $idUser)
    {
        if (!$user = $this->user->find($idUser)) {
            return redirect()->back()->with('danger', 'O código do usuário informado não consta em nossa base de dados!');
        }
        if (!$request->roles || count($request->roles) == 0) {
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos um cargo');
        }
        $user->roles()->attach($request->roles);
        return redirect()->route('users.roles', $user->id)->with('success', 'Cargos vinculados ao usuário com sucesso!');
    }

    public function detachRoleUser($idUser, $idRole)
    {
        $user = $this->user->find($idUser);
        $role = $this->role->find($idRole);
        if (!$user || !$role) {
            return redirect()->back()->with('danger', 'O código do usuário e/ou o código do cargo não consta(m) em nossa base de dados!');
        }
        $user->roles()->detach($role);
        return redirect()->route('users.roles', $user->id)->with('success', 'A remoção do vínculo entre o usuário e o cargo efetuada com sucesso!');
    }
}
