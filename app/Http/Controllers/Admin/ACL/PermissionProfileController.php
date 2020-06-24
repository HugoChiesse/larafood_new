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
    }

    public function profile($idPermission)
    {
        if (!$permission = $this->permission->find($idPermission)) {
            return redirect()->back()->with('warning', 'O código da permissão informado não existe!');
        }
        $title = "Perfis vinculados a permissão: |{$permission->name}|";
        $profiles = $permission->profiles()->orderBy('name')->paginate();
        return view('admin.pages.permissions.profiles.profiles', compact('permission', 'title', 'profiles'));
    }

}
