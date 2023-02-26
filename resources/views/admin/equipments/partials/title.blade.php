@if (Route::is('equipments.index'))
    Equipments
@elseif(Route::is('equipments.create'))
    Create New Equipment
@elseif(Route::is('equipments.edit'))
    Edit Equipment
@endif
    | Admin Panel - 
    {{ config('app.name') }}