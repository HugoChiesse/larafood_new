<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{
    protected $profile, $permission;

    public function __construct(Profile $profile, Permission $permission)
    {
        $this->profile = $profile;
        $this->permission = $permission;

        $this->middleware(['can:profiles']);
    }

    public function permissions($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        $title = "Permissões do Perfil |$profile->name|";

        if (!$profile) {
            return redirect()->back()->with('danger', 'O código do perfil informado não consta em nossa base de dados!');
        }

        $permissions = $profile->permissions()->paginate();

        return view('admin.pages.profiles.permissions.permissions', compact('profile', 'permissions', 'title'));
    }


    public function profiles($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('danger', 'O código da permissão informado não consta em nossa base de dados!');
        }
        $title = "Perfis da Permissão |{$permission->name}|";
        $profiles = $permission->profiles()->paginate();

        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'profiles', 'title'));
    }


    public function permissionsAvailable(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('danger', 'O código do perfil informado não consta em nossa base de dados!');
        }

        $filters = $request->except('_token');
        $title = "Associar Permissões ao Perfil |{$profile->name}|";
        $permissions = $profile->permissionsAvailable($request->filter);

        return view('admin.pages.profiles.permissions.available', compact('profile', 'permissions', 'filters', 'title'));
    }


    public function attachPermissionsProfile(Request $request, $idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back();
        }

        if (!$request->permissions || count($request->permissions) == 0) {
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos uma permissão');
        }

        $profile->permissions()->attach($request->permissions);

        return redirect()->route('profiles.permissions', $profile->id);
    }

    public function detachPermissionProfile($idProfile, $idPermission)
    {
        $profile = $this->profile->find($idProfile);
        $permission = $this->permission->find($idPermission);

        if (!$profile || !$permission) {
            return redirect()->back();
        }

        $profile->permissions()->detach($permission);

        return redirect()->route('profiles.permissions', $profile->id);
    }
}