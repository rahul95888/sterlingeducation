@if (Route::is('pops.index'))
    POPs
@elseif(Route::is('pops.create'))
    Create New POP
@elseif(Route::is('pops.edit'))
    Edit POP
@endif
    | Admin Panel - 
    {{ config('app.name') }}