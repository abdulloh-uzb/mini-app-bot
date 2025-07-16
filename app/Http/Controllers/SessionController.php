<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Session;
use App\Services\SessionService;
use Illuminate\Http\Request;

class SessionController extends Controller
{

    public function __construct(private SessionService $sessionService){}

    public function show(Session $session)
    {
        $attendances = $this->sessionService->sessionAttendances($session);
        return view("sessions.show", compact("attendances"));
    }

    public function setStatus(Request $request)
    {

        $validated = $request->validate([
            "session_id" => "required|exists:lesson_sessions,id",
            "student_id" => "required|exists:users,id",
            "status" => "required|in:present,absent,late"
        ]);
        
        $this->sessionService->setAttendance($validated['session_id'], $validated['student_id'], $validated['status']);

        return redirect()->back();
    }

}
