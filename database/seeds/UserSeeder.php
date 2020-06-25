<?php

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $tenant->users()->create([
            'name' => 'Hugo Ferreira Chiesse',
            'email' => 'hugochiesse@gmail.com',
            'password' => bcrypt('33225247')
        ]);
    }
}
