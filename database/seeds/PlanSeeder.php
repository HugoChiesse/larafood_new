<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'Businers',
            'url' => 'businers',
            'price' => 499.99,
            'description' => 'Plano Completo'
        ]);
        Plan::create([
            'name' => 'Free',
            'url' => 'free',
            'price' => 0.00,
            'description' => 'Plano Gratuito'
        ]);
        Plan::create([
            'name' => 'Premium',
            'url' => 'premium',
            'price' => 299.99,
            'description' => 'Plano Prémio'
        ]);
    }
}
