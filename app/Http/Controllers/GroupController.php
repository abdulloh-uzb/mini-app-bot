<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = auth()->user()->teacherGroups()->with("students")->get();

        $activeCount = $groups->filter(function ($group) {
            return $group->status === 'active';
        })->count();

        $inactiveCount = $groups->filter(function ($group) {
            return $group->status === 'inactive';
        })->count();

        $demoCount = $groups->filter(function ($group) {
            return $group->status === 'demo';
        })->count();

        return view('groups.index', compact("groups", "activeCount", "inactiveCount", "demoCount"));
    }

    public function show(Group $group)
    {
        $students = $group->students;
        return view("groups.show", compact("group", "students"));

    }

}
