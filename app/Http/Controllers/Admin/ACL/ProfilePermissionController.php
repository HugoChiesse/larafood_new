<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilePermissionController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissions($idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('danger', 'O código do perfil informado não consta em nossa base de dados!');
        }
        $title = "Permissões do Perfil: |{$profile->name}|";
        $permissions = $profile->permissions()->orderBy('name')->paginate();
        return view('admin.pages.profiles.permissions.permissions', compact('title', 'permissions', 'profile'));
    }

    public function createPermission(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('warning', 'Não foi possível associar a permissão ao perfil, tente mais tarde.');
        }
        $title = "Permissões Disponíveis Para o Perfil: {$profile->name}";
        $filters = $request->except('_token');
        $permissions = $profile->permissionNotAttach($request->filter);
        return view('admin.pages.profiles.permissions.createPermission', compact('title', 'permissions', 'profile', 'filters'));
    }

    public function storePermission(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('warning', 'Não foi possível associar a permissão ao perfil, tente mais tarde.');
        }
        if (!$request->permissions || count($request->permissions) === 0) {
            return redirect()->back()->with('warning', 'Você precisa escolher pelo menos uma permissão!');
        }
        $profile->permissions()->attach($request->permissions);
        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function removePermission($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);
        if (!$profile || !$permission) {
            return redirect()->back()->with('warning', 'O código do perfil e/ou código da permissão não está(ão) correto(s)');
        }
        $profile->permissions()->detach($permission);
        return redirect()->back()->with('success', 'Permissão desvinvulada com sucesso!');
    }
}
