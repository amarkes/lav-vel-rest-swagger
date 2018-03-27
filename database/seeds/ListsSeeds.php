<?php

use Illuminate\Database\Seeder;
use App\Lists;
class ListsSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 2001; $i++) {
            App\Lists::create([
                'name' => str_random(10),
                'status' => 'A',
            ]);
        }
    }
}
