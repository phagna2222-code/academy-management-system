@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.users.edit',
    'deleteRoute'  => 'admin.users.destroy',
    'editParam'    => 'user',
])
