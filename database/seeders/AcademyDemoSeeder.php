<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\Academy;
use App\Models\Campus;
use App\Models\Program;
use App\Models\Role;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AcademyDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Demo academy
        $academy = Academy::updateOrCreate(
            ['code' => 'AMS-DEMO'],
            [
                'name' => 'Golden Academy',
                'owner_name' => 'Golden Nature Sounds',
                'phone' => '+855 123 456 789',
                'email' => 'info@example.com',
                'website' => 'https://example.com',
                'address' => 'Phnom Penh, Cambodia',
                'status' => 'active',
            ],
        );

        // Three campuses (multi-branch)
        $campusData = [
            ['code' => 'PP01', 'name' => 'Phnom Penh Main',  'is_main' => true],
            ['code' => 'SR01', 'name' => 'Siem Reap Branch', 'is_main' => false],
            ['code' => 'BB01', 'name' => 'Battambang Branch', 'is_main' => false],
        ];

        $campuses = collect($campusData)->map(function ($c) use ($academy) {
            return Campus::updateOrCreate(
                ['academy_id' => $academy->id, 'code' => $c['code']],
                [
                    'name' => $c['name'],
                    'is_main' => $c['is_main'],
                    'phone' => '+855 99 000 '.rand(100, 999),
                    'email' => strtolower($c['code']).'@example.com',
                    'address' => $c['name'].', Cambodia',
                    'status' => 'active',
                ],
            );
        });

        // Super admin user (login: admin@example.com / password)
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'academy_id' => $academy->id,
                'campus_id' => $campuses->first()->id,
                'name' => 'Super Admin',
                'phone' => '+855 99 000 001',
                'password' => Hash::make('password'),
                'user_type' => 'super_admin',
                'status' => 'active',
            ],
        );

        $superRole = Role::where('slug', 'super-admin')->first();
        if ($superRole) {
            $superAdmin->roles()->syncWithoutDetaching([$superRole->id]);
        }

        // Academy admin
        $academyAdmin = User::updateOrCreate(
            ['email' => 'academy.admin@example.com'],
            [
                'academy_id' => $academy->id,
                'campus_id' => $campuses->first()->id,
                'name' => 'Academy Admin',
                'password' => Hash::make('password'),
                'user_type' => 'admin',
                'status' => 'active',
            ],
        );
        if ($role = Role::where('slug', 'academy-admin')->first()) {
            $academyAdmin->roles()->syncWithoutDetaching([$role->id]);
        }

        // Academic year + 2 semesters
        $year = AcademicYear::updateOrCreate(
            ['academy_id' => $academy->id, 'name' => '2026-2027'],
            [
                'start_date' => '2026-09-01',
                'end_date' => '2027-08-31',
                'is_current' => true,
                'status' => 'active',
            ],
        );

        Semester::updateOrCreate(
            ['academic_year_id' => $year->id, 'name' => 'Semester 1'],
            [
                'academy_id' => $academy->id,
                'start_date' => '2026-09-01', 'end_date' => '2027-01-31',
                'sort_order' => 1, 'status' => 'active',
            ],
        );
        Semester::updateOrCreate(
            ['academic_year_id' => $year->id, 'name' => 'Semester 2'],
            [
                'academy_id' => $academy->id,
                'start_date' => '2027-02-01', 'end_date' => '2027-07-31',
                'sort_order' => 2, 'status' => 'active',
            ],
        );

        // Programs + subjects
        $programs = [
            ['code' => 'ENG', 'name' => 'English'],
            ['code' => 'MATH', 'name' => 'Mathematics'],
            ['code' => 'CS', 'name' => 'Computer Science'],
        ];

        foreach ($programs as $i => $p) {
            $program = Program::updateOrCreate(
                ['academy_id' => $academy->id, 'campus_id' => $campuses[$i % $campuses->count()]->id, 'code' => $p['code']],
                [
                    'name' => $p['name'],
                    'duration_years' => 2,
                    'description' => $p['name'].' program',
                    'status' => 'active',
                ],
            );

            foreach (['101', '102'] as $level) {
                Subject::updateOrCreate(
                    ['program_id' => $program->id, 'code' => "{$p['code']}{$level}"],
                    [
                        'academy_id' => $academy->id,
                        'name' => "{$p['name']} {$level}",
                        'credit' => 3.0,
                        'status' => 'active',
                    ],
                );
            }
        }
    }
}
