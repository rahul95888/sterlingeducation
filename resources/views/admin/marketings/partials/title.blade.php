@if (Route::is('marketings.index'))
    Marketing and Promo 
@elseif(Route::is('marketings.create'))
    Create New Marketing and Promo
@elseif(Route::is('marketings.edit'))
    Edit Marketing and Promo
@endif
    | Admin Panel - 
    {{ config('app.name') }}