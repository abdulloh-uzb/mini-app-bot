<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Session;
use Carbon\Carbon;

class SessionService
{

    public function checkAttendance($sessionId)
    {

        $attendances = Attendance::where("session_id", $sessionId)->get();

        if (!$attendances) {
            return false;
        }

        $studentsCount = Session::find($sessionId)->group->students->count();

        if ($attendances->count() != $studentsCount) {
            return false;
        }

        return true;
    }

    public function setAttendance($sessionId, $studentId, $status)
    {

        $attendance = Attendance::where("session_id", $sessionId)
            ->where("student_id", $studentId)
            ->first();

        $attendance->update([
            "student_id" => $studentId,
            "session_id" => $sessionId,
            "status" => $status
        ]);


        return true;
    }

    public function sessionAttendances(Session $session)
    {
        $students = $session->group->students;
        $attendances = $session->attendances;

        $studentIds = $attendances->pluck('student_id')->toArray();

        foreach ($students as $student) {
            if (!in_array($student->id, $studentIds)) {

                $attendances[] = Attendance::create([
                    'session_id' => $session->id,
                    'student_id' => $student->id,
                    'status' => 'absent'
                ]);
            }
        }
        return $attendances;
    }

    public function getSession($date)
    {
        $todayGroups = Session::where("date", $date)->with("group")->get();

        $groupsAttendanceCompleted = 0;
        $groupsAttendanceNotCompleted = 0;

        $todayGroups = $todayGroups->transform(function ($item) use (&$groupsAttendanceCompleted, &$groupsAttendanceNotCompleted) {
            $result = $this->checkAttendance($item->id);
            $item->is_attendance_completed = $result;

            if ($result) {
                $groupsAttendanceCompleted++;
            } else {
                $groupsAttendanceNotCompleted++;
            }

            return $item;
        });

        return [$todayGroups, $groupsAttendanceCompleted, $groupsAttendanceNotCompleted];
    }

}
