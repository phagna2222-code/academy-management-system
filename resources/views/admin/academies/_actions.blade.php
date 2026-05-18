@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.academies.edit',
    'deleteRoute'  => 'admin.academies.destroy',
    'editParam'    => 'academy',
])
