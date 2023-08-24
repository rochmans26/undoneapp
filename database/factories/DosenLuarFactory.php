<?php

namespace Database\Factories;

use App\Models\DosenLuar;
use Illuminate\Database\Eloquent\Factories\Factory;

class DosenLuarFactory extends Factory
{
    protected $model = DosenLuar::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'nidn_dosen_luar' => $this->faker->randomNumber(5, true),
            'nm_dosen_luar' => $this->faker->name(),
            'telp_dosen_luar' => $this->faker->phoneNumber(),
            'email_dosen_luar' => $this->faker->unique()->safeEmail(),
            'fakultas_dosen_luar' => $this->faker->randomElement(['Fakultas Teknik', 'Fakultas Ilmu Komunikasi', 'Fakultas Ekonomi Bisnis', 'Fakultas Psikologi']),
            'prodi_dosen_luar' => $this->faker->randomElement(['Bisnis Manajemen', 'Informatika', 'Psikologi', 'Keuangan dan Akuntansi', 'Ilmu Komunikasi', 'Sipil', 'Elektro']),
            'universitas_dosen_luar' => $this->faker->randomElement(['Universitas Indonesia', 'Universitas Gadjah Mada', 'Universitas Brawijaya', 'Universitas Airlangga', 'Telkom University'])
        ];
    }
}
