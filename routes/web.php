<?php

use App\Http\Controllers\Admin\AcademicYearController;
use App\Http\Controllers\Admin\AcademyController;
use App\Http\Controllers\Admin\CampusController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SemesterController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('admin.dashboard'));

// Auth routes (manual)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Admin area
Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');

        // Profile
        Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::patch('profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

        // Each CRUD module only needs index + data (Livewire handles create/edit/delete).
        $crud = function (string $name, string $controller, string $module) {
            Route::middleware("permission:{$module}.view")->group(function () use ($name, $controller) {
                Route::get($name, [$controller, 'index'])->name("{$name}.index");
                Route::get("{$name}/data", [$controller, 'data'])->name("{$name}.data");
            });
        };

        $crud('academies', AcademyController::class, 'academy');
        $crud('campuses', CampusController::class, 'campus');
        $crud('users', UserController::class, 'user');
        $crud('roles', RoleController::class, 'role');
        $crud('permissions', PermissionController::class, 'permission');
        $crud('academic-years', AcademicYearController::class, 'academic_year');
        $crud('semesters', SemesterController::class, 'semester');
        $crud('programs', ProgramController::class, 'program');
        $crud('subjects', SubjectController::class, 'subject');
        $crud('teachers', TeacherController::class, 'teacher');
        $crud('students', StudentController::class, 'student');
        $crud('class-rooms', ClassRoomController::class, 'class_room');
        $crud('enrollments', EnrollmentController::class, 'enrollment');
    });
