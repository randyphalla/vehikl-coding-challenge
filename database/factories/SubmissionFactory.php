<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Submission;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'current_odometer' => fake()->randomNumber(5, true),
            'previous_oil_change_odometer'  => fake()->randomNumber(5, true),
            'previous_oil_change_date'  => fake()->date('Y-m-d'),
        ];
    }

    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Submission::class;

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (Submission $submission) {

        })->afterCreating(function (Submission $submission) {

        });
    }

    public function odometerIsLessThan5KM(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'current_odometer' => 4000,
                'previous_oil_change_odometer' => 3000,
                // 'previous_oil_change_date' => '2025-12-26',
                'previous_oil_change_date' => Carbon::parse('2025-12-26 00:00:00'),
            ];
        });
    }

    public function odometerIsOver5KM(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'current_odometer' => 8000,
                'previous_oil_change_odometer' => 4000,
                // 'previous_oil_change_date' => '2025-12-26',
                'previous_oil_change_date' => Carbon::parse('2025-12-26 00:00:00'),
            ];
        });
    }

    public function previousOdometerGreaterThanOdometer(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'current_odometer' => 2000,
                'previous_oil_change_odometer' => 4000,
                // 'previous_oil_change_date' => '2025-12-26',
                'previous_oil_change_date' => Carbon::parse('2025-12-26 00:00:00'),
            ];
        });
    }

    public function overSixMonths(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'current_odometer' => 4000,
                'previous_oil_change_odometer' => 3000,
                // 'previous_oil_change_date' => '2025-01-27',
                'previous_oil_change_date' => Carbon::parse('2025-01-26 00:00:00'),
            ];
        });
    }

    public function needsOilChange(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'current_odometer' => 8000,
                'previous_oil_change_odometer' => 4000,
                // 'previous_oil_change_date' => '2025-01-27',
                'previous_oil_change_date' => Carbon::parse('2025-01-26 00:00:00'),
            ];
        });
    }
}
