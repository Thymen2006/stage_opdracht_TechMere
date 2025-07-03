<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventPrefixes = ['Summer', 'Electric', 'Urban', 'Neon', 'Midnight', 'Golden', 'Crystal', 'Silent', 'Loud', 'Vivid'];
        $eventTypes = ['Beats', 'Groove', 'Vibes', 'Sounds', 'Festival', 'Experience', 'Night', 'Sessions', 'Party', 'Rave'];

        // Create a random event name by combining a prefix + a type
        $eventName = $this->faker->randomElement($eventPrefixes) . ' ' . $this->faker->randomElement($eventTypes);

        $locations = [
            'Amsterdam',
            'Rotterdam',
            'Utrecht',
            'Eindhoven',
            'Groningen',
            'Arnhem',
            'Den Haag',
            'Maastricht',
            'Leeuwarden',
            'Tilburg',
            'Almere'
        ];

        return [
            'event_name' => $eventName,
            'event_date' => $this->faker->dateTimeBetween('now', '+12 months'),
            'event_locatie' => $this->faker->randomElement($locations),
        ];
    }
}
