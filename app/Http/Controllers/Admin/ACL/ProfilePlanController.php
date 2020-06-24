<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfilePlanController extends Controller
{
    protected $plan, $profile;
    
    public function __construct(Plan $plan, Profile $profile)
    {
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function plans($idProfile)
    {
        if (!$profile = $this->profile->find($idProfile)) {
            return redirect()->back()->with('warning', 'O código informando não está associado a nenhum perfil!');
        }
        $title = "Planos Associados ao Perfil |{$profile->name}|";
        $plans = $profile->plans()->orderBy('name')->paginate();
        return view('admin.pages.profiles.plans.plans', compact('title', 'plans', 'profile'));
    }
}
