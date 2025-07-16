<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Session;
use App\Models\User;
use App\Services\SessionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TeacherController extends Controller
{

    public function __construct(private SessionService $sessionService) {}

    public function home(Request $request)
    {
        $user = null;
        if ($request->has('tg_id')) {
            $user = User::where('tg_id', $request->tg_id)->first();
        } else {
            $user = Auth::user();
        }

        if (!$user) {
            abort(401, 'Foydalanuvchi aniqlanmadi');
        }

        Auth::login($user);

        // $todayGroups = Session::where("date", Carbon::today()->format("Y-m-d"))->with("group")->get();

        // $groupsAttendanceCompleted = 0;
        // $groupsAttendanceNotCompleted = 0;

        // $todayGroups = $todayGroups->transform(function ($item) use (&$groupsAttendanceCompleted, &$groupsAttendanceNotCompleted) {
        //     $result = $this->sessionService->checkAttendance($item->id);
        //     $item->is_attendance_completed = $result;

        //     if ($result) {
        //         $groupsAttendanceCompleted++;
        //     } else {
        //         $groupsAttendanceNotCompleted++;
        //     }

        //     return $item;
        // });

        [$todayGroups, $groupsAttendanceCompleted, $groupsAttendanceNotCompleted] = $this->sessionService->getSession(Carbon::today()->format("Y-m-d"));

        return view('teachers.home', compact("todayGroups", "groupsAttendanceCompleted", "groupsAttendanceNotCompleted"));
    }
}
