<?php

namespace Database\Factories;

use App\Models\Pelanggaran;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PelanggaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pelanggaran::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $jenis = $this->faker->randomElement(['prestasi', 'pelanggaran']);
        $poin = $jenis === 'prestasi' ? $this->faker->numberBetween(1, 20) : $this->faker->numberBetween(-20, -1);

        return [
            'student_id' => Student::factory(),
            'jenis' => $jenis,
            'kategori' => $this->faker->randomElement(['akademik', 'non-akademik']),
            'poin' => $poin,
            'keterangan' => $this->faker->sentence(),
            'sanksi' => $poin < 0 ? $this->faker->randomElement(['ditegur', 'dihukum ringan']) : null,
            'tanggal' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'created_by' => User::factory(),
        ];
    }
}
