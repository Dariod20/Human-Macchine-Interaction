<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Tariffa;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tariffa>
 */
class TariffaFactory extends Factory
{
    protected $model = Tariffa::class;
   
    public function definition(): array
    {
        $uniqueDate = $this->faker->unique()->dateTimeBetween('-30 days', 'now');


        while(Tariffa::query()->where('giorno', $uniqueDate)->first()) {
            $uniqueDate = $this->faker->dateTimeBetween('-30 days', 'now');
        }

        return [

            'giorno' => $uniqueDate,
            'prezzo' => $this->faker->numberBetween(100,250),
        ];
       
    }
}
