<?php

use App\Models\Plan;
use Illuminate\Database\Seeder;

class DetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $businers = Plan::where('url', 'businers')->first();
        $businers->details()->create(['name' => 'Categorias']);
        $businers->details()->create(['name' => 'Produtos']);
        $businers->details()->create(['name' => 'Mesas']);
        $businers->details()->create(['name' => 'Cardápio']);
        $businers->details()->create(['name' => 'Suporte']);

        $premium = Plan::where('url', 'premium')->first();
        $premium->details()->create(['name' => 'Categorias']);
        $premium->details()->create(['name' => 'Produtos']);
        $premium->details()->create(['name' => 'Mesas']);
        $premium->details()->create(['name' => 'Cardápio']);

        $free = Plan::where('url', 'free')->first();
        $free->details()->create(['name' => 'Categorias']);
        $free->details()->create(['name' => 'Produtos']);
    }
}
