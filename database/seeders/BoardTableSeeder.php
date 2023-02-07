<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        DB::table("boards")->truncate();

        $boards = ['TO-DO', 'IN-PROGRESS', 'DONE'];

        foreach($boards as $board) {
            Board::create([
                'board_name' => $board,
            ]);
        }
    }
}
