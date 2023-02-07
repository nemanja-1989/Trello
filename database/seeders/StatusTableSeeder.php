<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS = 0");
        DB::table("statuses")->truncate();

        $statuses = ['TO-DO', 'IN-PROGRESS', 'DONE'];

        foreach($statuses as $status) {
            Status::create([
                'status_name' => $status,
            ]);
        }
    }
}
