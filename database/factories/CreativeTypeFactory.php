<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CreativeType>
 */
class CreativeTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
                // 'name' => fake()->unique()->randomElement(['Expendable Video', 'Video Canvas', 'Scratch', 'Carousel']),
            'name' => fake()->unique()->randomElement([
                'Carousel', 'Scratch', 'Video Canvas', 'Video with Image Carousel', 'Video with Image Slider', 'Interactive Image Slider', 'Image Hover Animation', 'Hit to Unveil', 'Pop & Reveal', 'Scratch to Reveal', '3D Rotating Animation', 'Expandable Images', 'Image With Countdown', 'Scratch To Reveal Video', 'Video & Image Expand On Hover', 'Products Slider', 'Location Based Ads', 'Responsive 3D Cube', 'Stories Ads', 'Creative Swiper', 'Creative Image Animation'
            ]),
        ];
    }

}
