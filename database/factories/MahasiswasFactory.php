<?php

namespace Database\Factories;

use App\Models\Mahasiswas;
use Illuminate\Database\Eloquent\Factories\Factory;

class MahasiswasFactory extends Factory
{
    protected $model = Mahasiswas::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'npm' => $this->faker->randomNumber(5, true),
            'nm_mahasiswa' => $this->faker->name(),
            'id_prodi' => mt_rand(1,4),
            'thn_masuk' => $this->faker->randomElement(['2019', '2020', '2021', '2022', '2023', '2024']),
        ];
    }
}
