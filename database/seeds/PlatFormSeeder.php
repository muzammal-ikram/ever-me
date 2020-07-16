<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class PlatFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::enableForeignKeyConstraints();
        DB::table('platforms')->insert([
                [
                    'platform_name' => 'Airbnb',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'platform_name' => 'HomeAway',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'platform_name' => 'Booking.com',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'platform_name' => 'Vrbo',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                
            ]
        );
    }
}
