<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\Kelas;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nis' => $this->faker->unique()->numerify('S######'),
            'email' => $this->faker->unique()->safeEmail(),
            'kelas_id' => Kelas::inRandomOrder()->first()->id,
        ];
    }
}
