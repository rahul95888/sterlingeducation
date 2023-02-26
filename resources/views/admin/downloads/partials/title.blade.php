@if (Route::is('downloads.index'))
Downloads
@elseif(Route::is('downloads.create'))
    Create New Downloads
@elseif(Route::is('downloads.edit'))
    Edit Downloads
@endif
    | Admin Panel - 
    {{ config('app.name') }}