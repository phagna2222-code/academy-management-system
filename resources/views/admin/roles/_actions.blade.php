@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.roles.edit',
    'deleteRoute'  => 'admin.roles.destroy',
    'editParam'    => 'role',
])
