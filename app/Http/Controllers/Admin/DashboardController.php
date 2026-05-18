<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $stats = [
            'academies' => Academy::count(),
            'campuses' => Campus::count(),
            'teachers' => Teacher::count(),
            'students' => Student::count(),
            'users' => User::count(),
        ];

        return view('admin.dashboard.index', compact('stats'));
    }
}
