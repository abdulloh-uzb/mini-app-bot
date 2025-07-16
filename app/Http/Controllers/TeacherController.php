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

        [$todayGroups, $groupsAttendanceCompleted, $groupsAttendanceNotCompleted] = $this->sessionService->getSession(Carbon::today()->format("Y-m-d"));

        return view('teachers.home', compact("todayGroups", "groupsAttendanceCompleted", "groupsAttendanceNotCompleted"));
    }

    public function settings()
    {
        $user = Auth::user();
        if (!$user) {
            abort(401, 'Foydalanuvchi aniqlanmadi');
        }

        return view('teachers.settings', compact('user'));
    }


}
