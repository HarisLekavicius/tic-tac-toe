<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->delete();

        $games = array(
            array(
                'id' => 1,
                'currentPlayer' => 1,
                'winner' => 0,
            )
        );
        DB::table('games')->insert($games);

    }
}
