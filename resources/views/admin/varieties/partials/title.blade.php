@if (Route::is('varieties.index'))
    Varieties 
@elseif(Route::is('varieties.create'))
    Create New Variety
@elseif(Route::is('varieties.edit'))
    Edit Variety
@endif
    | Admin Panel - 
    {{ config('app.name') }}