@if (Route::is('mocktest.index'))
    MockTest
@elseif(Route::is('mocktest.create'))
    Create New MockTest
@elseif(Route::is('mocktest.edit'))
    Edit MockTest
@endif
    | Admin Panel - 
    {{ config('app.name') }}