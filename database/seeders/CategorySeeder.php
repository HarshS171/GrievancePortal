<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Electricity',
            'Water Supply',
            'Hostel Cleaning',
            'Internet/WiFi',
            'Food/Mess',
            'Plumbing',
            'Furniture',
            'Security',
            'Lift Issue',
            'Room Maintenance',
            'Other'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
