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

        // A small helper to declare a CRUD resource + its `data` endpoint, all
        // wrapped in the matching permission middleware.
        $crud = function (string $name, string $param, string $controller, string $module) {
            Route::middleware("permission:{$module}.view")->group(function () use ($name, $controller) {
                Route::get($name, [$controller, 'index'])->name("{$name}.index");
                Route::get("{$name}/data", [$controller, 'data'])->name("{$name}.data");
            });
            Route::middleware("permission:{$module}.create")->group(function () use ($name, $controller) {
                Route::get("{$name}/create", [$controller, 'create'])->name("{$name}.create");
                Route::post($name, [$controller, 'store'])->name("{$name}.store");
            });
            Route::middleware("permission:{$module}.edit")->group(function () use ($name, $param, $controller) {
                Route::get("{$name}/{{$param}}/edit", [$controller, 'edit'])->name("{$name}.edit");
                Route::put("{$name}/{{$param}}", [$controller, 'update'])->name("{$name}.update");
            });
            Route::middleware("permission:{$module}.delete")->group(function () use ($name, $param, $controller) {
                Route::delete("{$name}/{{$param}}", [$controller, 'destroy'])->name("{$name}.destroy");
            });
        };

        $crud('academies', 'academy', AcademyController::class, 'academy');
        $crud('campuses', 'campus', CampusController::class, 'campus');
        $crud('users', 'user', UserController::class, 'user');
        $crud('roles', 'role', RoleController::class, 'role');
        $crud('permissions', 'permission', PermissionController::class, 'permission');
        $crud('academic-years', 'academicYear', AcademicYearController::class, 'academic_year');
        $crud('semesters', 'semester', SemesterController::class, 'semester');
        $crud('programs', 'program', ProgramController::class, 'program');
        $crud('subjects', 'subject', SubjectController::class, 'subject');
        $crud('teachers', 'teacher', TeacherController::class, 'teacher');
        $crud('students', 'student', StudentController::class, 'student');
        $crud('class-rooms', 'classRoom', ClassRoomController::class, 'class_room');
        $crud('enrollments', 'enrollment', EnrollmentController::class, 'enrollment');
    });
