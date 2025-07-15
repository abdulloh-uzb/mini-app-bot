<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::find(2);

        // Create group1
        $group1 = $teacher->teacherGroups()->create([
            'title' => 'Beginner English Group',
            'start_time' => '10:00:00',
            'end_time' => '11:30:00',
            'duration' => 3,
            'start_date' => now(),
            'lesson_days' => json_encode(['monday', 'wednesday', 'friday']),
            'level' => 'beginner',
            'price' => 1500000,
            'status' => 'active',
        ]);

        // Create group2
        $group2 = $teacher->teacherGroups()->create([
            'title' => 'Intermediate English Group',
            'start_time' => '12:00:00',
            'end_time' => '13:30:00',
            'duration' => 3,
            'start_date' => now(),
            'lesson_days' => json_encode(['tuesday', 'thursday']),
            'level' => 'intermediate',
            'price' => 2000000,
            'status' => 'active',
        ]);

        $weekdays = $this->getWeekdaysForDays($group1->start_date, $group1->duration, json_decode($group1->lesson_days, true));
        $sessions = $weekdays->map(function ($date) {
            return [
                'date' => $date,
                'status' => 'scheduled',
            ];
        })->toArray();

        $group1->sessions()->createMany($sessions);

        $tuesdayThursday = $this->getWeekdaysForDays($group2->start_date, $group2->duration, json_decode($group2->lesson_days, true));
        $sessions2 = $tuesdayThursday->map(function ($date) {
            return [
                'date' => $date,
                'status' => 'scheduled',
            ];
        })->toArray();

        $group2->sessions()->createMany($sessions2);

        // Attach students
        $group1->students()->attach([5, 6]);
        $group2->students()->attach([7]);
    }

    public function getWeekdaysForDays($startDate, $monthsLater, $lessonDays)
    {
        $start = Carbon::parse($startDate);
        $end = $start->copy()->addMonths($monthsLater);
        $period = CarbonPeriod::create($start, $end);

        $dayMap = [
            'monday' => Carbon::MONDAY,
            'tuesday' => Carbon::TUESDAY,
            'wednesday' => Carbon::WEDNESDAY,
            'thursday' => Carbon::THURSDAY,
            'friday' => Carbon::FRIDAY,
            'saturday' => Carbon::SATURDAY,
            'sunday' => Carbon::SUNDAY,
        ];

        $targetDays = array_map(function ($day) use ($dayMap) {
            return $dayMap[strtolower($day)];
        }, $lessonDays);

        return collect($period)->filter(function ($date) use ($targetDays) {
            return in_array($date->dayOfWeek, $targetDays);
        })->map(function ($date) {
            return $date->format('Y-m-d');
        });
    }
}