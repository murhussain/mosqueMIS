<?php

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(DefaultThemeSeeder::class);
        $this->call(BlogCatSeeder::class);
        $this->call(GiftOptionsSeeder::class);
    }
}
