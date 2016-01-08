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
                    'type' => 'weapon',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                1 => [
                    'id' => 2,
                    'name' => 'Gaymaker',
                    'type' => 'weapon',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                2 => [
                    'id' => 3,
                    'name' => 'Gordon',
                    'type' => 'weapon',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                3 => [
                    'id' => 4,
                    'name' => 'Sheiva',
                    'type' => 'weapon',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                4 => [
                    'id' => 5,
                    'name' => 'Land Mine',
                    'type' => 'equipment',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                5 => [
                    'id' => 6,
                    'name' => 'HATR',
                    'type' => 'streak',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                6 => [
                    'id' => 7,
                    'name' => 'UAV',
                    'type' => 'streak',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                7 => [
                    'id' => 8,
                    'name' => 'Gravity Spikes',
                    'type' => 'specialist',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                8 => [
                    'id' => 9,
                    'name' => 'VMP',
                    'type' => 'weapon',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
                10 => [
                    'id' => 10,
                    'name' => 'm8ey',
                    'type' => 'weapon',
                    'game_title_id' => 1,
                    'created_at' => '0000-00-00 00:00:00',
                    'updated_at' => '0000-00-00 00:00:00',
                ],
            ]
        );
    }

}
