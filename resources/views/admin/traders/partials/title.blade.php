@if (Route::is('traders.index'))
    Traders
@elseif(Route::is('traders.create'))
    Create New Trader
@elseif(Route::is('traders.edit'))
    Edit Trader
@endif
    | Admin Panel - 
    {{ config('app.name') }}