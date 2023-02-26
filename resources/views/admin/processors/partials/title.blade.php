@if (Route::is('processors.index'))
Shop
@elseif(Route::is('processors.create'))
    Create New Shop
@elseif(Route::is('processors.edit'))
    Edit Shop
@endif
    | Admin Panel - 
    {{ config('app.name') }}