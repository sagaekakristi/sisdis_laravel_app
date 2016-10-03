<?php

use Illuminate\Database\Seeder;

use App\Models\VisitorCount;

class VisitorCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visitor_counter = new VisitorCount;
        $visitor_counter->description = 'Counter for Sisdis Load Balancer page. Increment one for each visit.';
        $visitor_counter->counter = 0;
        $visitor_counter->save();
    }
}
