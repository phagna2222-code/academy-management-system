@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.enrollments.edit',
    'deleteRoute'  => 'admin.enrollments.destroy',
    'editParam'    => 'enrollment',
])
