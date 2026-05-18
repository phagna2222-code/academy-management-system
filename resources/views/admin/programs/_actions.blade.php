@include('admin.components._actions', [
    'id'           => $row->id,
    'editRoute'    => 'admin.programs.edit',
    'deleteRoute'  => 'admin.programs.destroy',
    'editParam'    => 'program',
])
