<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DosensSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Dosens::factory(10)->create();
    }
}
