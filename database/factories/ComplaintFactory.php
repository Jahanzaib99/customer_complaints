<?php

namespace Database\Factories;

use App\Models\Complaint;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique()->safeEmail(),
            'description' => $this->faker->text(),
            'phone' => $this->faker->phoneNumber(),
            'user_id' => User::whereHas('roles', function($query) {
                $query->where('name', 'csr');
            })->get()->random()->id,
            'status' => Complaint::STATUS_ACTIVE
        ];
    }
}
