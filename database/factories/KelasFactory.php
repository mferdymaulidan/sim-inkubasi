<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kelas>
 */
class KelasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kelas' => function () {
                $kelas = fake()->randomElement(['X', 'XI', 'XII']);
                $jurusan = fake()->randomElement(['KPRW', 'TKJ', 'APHP', 'DKV']);
                $nama_kelas = fake()->randomElement(['1', '2', '3', '4', '5']);
                return $kelas . ' ' . $jurusan . ' ' . $nama_kelas;
            }
        ];
    }
}
