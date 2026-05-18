<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Global, academy-agnostic roles
        $roles = [
            [
                'slug' => 'super-admin',
                'name' => 'Super Admin',
                'description' => 'Global super administrator — full access.',
                'permissions' => '*',
            ],
            [
                'slug' => 'academy-admin',
                'name' => 'Academy Admin',
                'description' => 'Administrator of a single academy.',
                'permissions' => '*',
            ],
            [
                'slug' => 'campus-manager',
                'name' => 'Campus Manager',
                'description' => 'Manages a single campus / branch.',
                'permissions' => [
                    'campus.view',
                    'academic_year.view', 'semester.view',
                    'program.view', 'subject.view',
                    'teacher.view', 'teacher.create', 'teacher.edit',
                    'student.view', 'student.create', 'student.edit',
                    'class_room.view', 'class_room.create', 'class_room.edit',
                    'enrollment.view', 'enrollment.create', 'enrollment.edit',
                ],
            ],
            [
                'slug' => 'teacher',
                'name' => 'Teacher',
                'description' => 'Teacher role.',
                'permissions' => [
                    'campus.view', 'subject.view', 'student.view',
                    'class_room.view', 'enrollment.view',
                    'academic_year.view', 'semester.view',
                ],
            ],
            [
                'slug' => 'student',
                'name' => 'Student',
                'description' => 'Student role.',
                'permissions' => [],
            ],
        ];

        $allPermissionIds = Permission::pluck('id')->all();

        foreach ($roles as $data) {
            /** @var Role $role */
            $role = Role::updateOrCreate(
                ['academy_id' => null, 'slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'description' => $data['description'],
                    'status' => 'active',
                ],
            );

            if ($data['permissions'] === '*') {
                $role->permissions()->sync($allPermissionIds);
            } else {
                $ids = Permission::whereIn('slug', $data['permissions'])->pluck('id')->all();
                $role->permissions()->sync($ids);
            }
        }
    }
}
