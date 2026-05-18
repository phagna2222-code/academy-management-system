@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.permissions.edit',
    'deleteRoute'  => 'admin.permissions.destroy',
    'editParam'    => 'permission',
])
