<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    protected $role, $permission;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;

        $this->middleware(['can:roles']);
    }

    public function permissions($idRole)
    {
        $role = $this->role->find($idRole);
        $title = "Permissões do Cargo |{$role->name}|";

        if (!$role) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }

        $permissions = $role->permissions()->orderBy('name')->paginate();

        return view('admin.pages.roles.permissions.permissions', compact('role', 'permissions', 'title'));
    }


    public function roles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('danger', 'O código da permissão informado não consta em nossa base de dados!');
        }
        $title = "Cargos da Permissão |{$permission->name}|";
        $roles = $permission->roles()->orderBy('name')->paginate();

        return view('admin.pages.permissions.roles.roles', compact('permission', 'roles', 'title'));
    }


    public function permissionsAvailable(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }

        $filters = $request->except('_token');
        $title = "Associar Permissões ao Cargo |{$role->name}|";
        $permissions = $role->permissionsAvailable($request->filter);

        return view('admin.pages.roles.permissions.available', compact('role', 'permissions', 'filters', 'title'));
    }


    public function attachPermissionsRole(Request $request, $idRole)
    {
        if (!$role = $this->role->find($idRole)) {
            return redirect()->back()->with('danger', 'O código do cargo informado não consta em nossa base de dados!');
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()
                ->back()
                ->with('warning', 'Precisa escolher pelo menos uma permissão!');
        }

        $role->permissions()->attach($request->permissions);

        return redirect()->route('roles.permissions', $role->id)->with('success', 'Vículo entre cargo e permissões executada com sucesso!');
    }

    public function detachPermissionRole($idRole, $idPermission)
    {
        $role = $this->role->find($idRole);
        $permission = $this->permission->find($idPermission);

        if (!$role || !$permission) {
            return redirect()->back()->with('danger', 'O código do cargo e/ou o código da permissão não está(ão) correto(s). Tente outra vez!');
        }

        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions', $role->id);
    }
}
