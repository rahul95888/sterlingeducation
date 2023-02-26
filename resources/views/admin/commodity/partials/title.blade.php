@if (Route::is('commodities.index'))
    Commodities 
@elseif(Route::is('commodities.create'))
    Create New Commodity
@elseif(Route::is('commodities.edit'))
    Edit Commodity
@endif
    | Admin Panel - 
    {{ config('app.name') }}