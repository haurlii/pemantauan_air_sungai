<?php

namespace Database\Seeders;

use App\Models\Normal;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WaterLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Normal::create([
        //     "code_type" => "Racket",
        //     "type" => "Racket",
        // ]);
        $data = [];
        $daysOfWeek = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];



        for ($i = 0; $i < 30; $i++) {
            $day = rand(15, 30);
            $month = 8;
            $year = 2024;
            $date = Carbon::createFromDate($year, $month, $day)->toDateString();
            $time = Carbon::now()->subMinutes(rand(0, 1440))->toTimeString();
            $level = rand(0, 50) / 10;

            if ($level > 3) {
                $action = 'Danger';
            } elseif ($level <= 3 && $level >= 1) {
                $action = 'Warning';
            } else {
                $action = 'Safe';
            }

            // Tentukan nama hari berdasarkan tanggal
            $dayName = $daysOfWeek[Carbon::parse($date)->dayOfWeek];

            $data[] = [
                'days' => $dayName,
                'date' => $date,
                'time' => $time,
                'level' => $level,
                'action' => $action,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Normal::insert($data);
    }
}
