<?php

use Illuminate\Database\Seeder;

class ItemTableSeeder extends Seeder {

    //add some items to the items table for testing
    public function run()
    {
        \DB::table('item')->delete();

        \DB::table('item')->insert(
            [ 
                0 => [
                    'id' => 1,
                    'name' => 'Vesper',
                    'is_weapon' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                1 => [
                    'id' => 2,
                    'name' => 'Gaymaker',
                    'is_weapon' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                2 => [
                    'id' => 3,
                    'name' => 'Gordon',
                    'is_weapon' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                3 => [
                    'id' => 4,
                    'name' => 'Sheiva',
                    'is_weapon' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                4 => [
                    'id' => 5,
                    'name' => 'Land Mine',
                    'is_equipment' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                5 => [
                    'id' => 6,
                    'name' => 'HATR',
                    'is_streak' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                6 => [
                    'id' => 7,
                    'name' => 'UAV',
                    'is_streak' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                7 => [
                    'id' => 8,
                    'name' => 'Gravity Spikes',
                    'is_specialist' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                8 => [
                    'id' => 9,
                    'name' => 'VMP',
                    'is_weapon' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                10 => [
                    'id' => 10,
                    'name' => 'm8ey',
                    'is_weapon' => true,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
            ]
        );
    }

}
