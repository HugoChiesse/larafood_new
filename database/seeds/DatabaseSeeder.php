<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlanSeeder::class);
        $this->call(TenantSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DetailsSeeder::class);
    }
}
