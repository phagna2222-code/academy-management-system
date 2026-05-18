@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.students.edit',
    'deleteRoute'  => 'admin.students.destroy',
    'editParam'    => 'student',
])
