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
            ['name' => 'Electricity',      'officer_name' => 'Rajesh Kumar',     'officer_phone' => '9876501234'],
            ['name' => 'Water Supply',     'officer_name' => 'Suresh Patel',      'officer_phone' => '9823456701'],
            ['name' => 'Hostel Cleaning',  'officer_name' => 'Mohan Singh',       'officer_phone' => '9812345670'],
            ['name' => 'Internet/WiFi',    'officer_name' => 'Amit Sharma',       'officer_phone' => '9901234567'],
            ['name' => 'Food/Mess',        'officer_name' => 'Priya Nair',        'officer_phone' => '9856789012'],
            ['name' => 'Plumbing',         'officer_name' => 'Dinesh Verma',      'officer_phone' => '9778901234'],
            ['name' => 'Furniture',        'officer_name' => 'Karan Mehta',       'officer_phone' => '9934567890'],
            ['name' => 'Security',         'officer_name' => 'Vikram Yadav',      'officer_phone' => '9867890123'],
            ['name' => 'Lift Issue',       'officer_name' => 'Sanjay Gupta',      'officer_phone' => '9745678901'],
            ['name' => 'Room Maintenance', 'officer_name' => 'Deepak Tiwari',     'officer_phone' => '9689012345'],
            ['name' => 'Other',            'officer_name' => 'Helpdesk Officer',  'officer_phone' => '9600000000'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['name' => $category['name']],
                [
                    'officer_name'  => $category['officer_name'],
                    'officer_phone' => $category['officer_phone'],
                ]
            );
        }
    }
}
