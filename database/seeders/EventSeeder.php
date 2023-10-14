<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'title'=>'MDC Intramurals',
                'Schedule' => 'October 10, 2023',
                'venue' => 'Mater Dei College',
                'user_id' => 1,
                'computation' => 'Averaging'
            ],
            [
                'title'=>'MDC Intramurals',
                'Schedule' => 'October 10, 2023',
                'venue' => 'Mater Dei College',
                'user_id' => 1,
                'computation' => 'Ranking'

            ],
            [
                'title'=>'MDC Intramurals',
                'Schedule' => 'October 10, 2023',
                'venue' => 'Mater Dei College',
                'user_id' => 1,
                'computation' => 'Complex'

            ]
        ];

        foreach($events as $event) {
            Event::create($event);
        }
    }
}
