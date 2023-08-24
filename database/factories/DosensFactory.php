<?php

namespace Database\Factories;

use App\Models\Dosens;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosensFactory extends Factory
{
    protected $model = Dosens::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nidn' => $this->faker->randomNumber(5, true),
            'nm_dosen' => $this->faker->name(),
            'telp' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'alamat_dosen' => $this->faker->address(),
            'jafung' => $this->faker->randomElement(['Lektor', 'Lektor Kepala', 'Asisten Ahli']),
            'id_prodi' => mt_rand(1,4)
        ];
    }
}
