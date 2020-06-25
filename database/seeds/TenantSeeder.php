<?php

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $plan->tenants()->create([
            'cnpj' => '12345679865465',
            'name' => 'H&Y Consultoria em Ti',
            'url' => 'h&y-consultoria-em-ti',
            'email' => 'hugochiesse@gmail.com'
        ]);
    }
}
