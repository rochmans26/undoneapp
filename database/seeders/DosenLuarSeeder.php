<?php

namespace Database\Seeders;

use App\Models\DosenLuar;
use Illuminate\Database\Seeder;

class DosenLuarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DosenLuar::factory(10)->create();
    }
}
