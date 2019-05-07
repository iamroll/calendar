<?php

use Illuminate\Database\Seeder;

use App\Model\Route;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'fly_from' => 'ALA',
                'fly_to' => 'TSE'
            ],
            [
                'fly_from' => 'TSE',
                'fly_to' => 'ALA'
            ],
            [
                'fly_from' => 'ALA',
                'fly_to' => 'MOW'
            ],
            [
                'fly_from' => 'MOW',
                'fly_to' => 'ALA'
            ],
            [
                'fly_from' => 'ALA',
                'fly_to' => 'CIT'
            ],
            [
                'fly_from' => 'CIT',
                'fly_to' => 'ALA'
            ],
            [
                'fly_from' => 'TSE',
                'fly_to' => 'MOW'
            ],
            [
                'fly_from' => 'MOW',
                'fly_to' => 'TSE'
            ],
            [
                'fly_from' => 'TSE',
                'fly_to' => 'LED'
            ],
            [
                'fly_from' => 'LED',
                'fly_to' => 'TSE'
            ]
        ];

        foreach ($rows as $row) {
            Route::create($row);
        }
    }
}
