<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender=rand(0,1)?'men':'women';
        $name = ($gender==='men')?fake()->name('male'):fake()->name('female');
        $avatarUrl = 'https://randomuser.me/api/portraits/'.$gender.'/' . rand(0, 99) . '.jpg';
        $vk ="https://vk.com/id" . fake()->numberBetween(700,800);
        $tg ="https://t.me/" . $name;
        $inst ="https://www.instagram.com/" . $name;

        return [
            'username' => $name,
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'avatar'=>$avatarUrl,
            'status_id'=>fake()->numberBetween(1,3),
            'job'=>fake()->jobTitle(),
            'company'=>fake()->company(),
            'phone'=>fake()->phoneNumber(),
            'address'=>fake()->address(),
            'country'=>fake()->country(),
            'city'=>fake()->city(),
            'vk'=>$vk,
            'tg'=>$tg,
            'inst'=>$inst,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
