<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PermissionSeeder extends Seeder
{
    /**
     * Each module has CRUD-style permissions (view / create / edit / delete).
     */
    public function run(): void
    {
        $modules = [
            'academy' => 'Academy',
            'campus' => 'Campus / Branch',
            'user' => 'User',
            'role' => 'Role',
            'permission' => 'Permission',
            'academic_year' => 'Academic Year',
            'semester' => 'Semester',
            'program' => 'Program',
            'subject' => 'Subject',
            'teacher' => 'Teacher',
            'student' => 'Student',
            'class_room' => 'Class Room',
            'enrollment' => 'Enrollment',
        ];

        $actions = ['view', 'create', 'edit', 'delete'];

        foreach ($modules as $key => $label) {
            foreach ($actions as $action) {
                $slug = "{$key}.{$action}";
                Permission::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'module' => $key,
                        'name' => Str::title($action).' '.$label,
                        'description' => "Allow {$action} on {$label}",
                    ],
                );
            }
        }
    }
}
