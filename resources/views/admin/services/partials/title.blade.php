@if (Route::is('services.index'))
Faq
@elseif(Route::is('services.create'))
    Create New Faq
@elseif(Route::is('services.edit'))
    Edit Faq
@endif
    | Admin Panel - 
    {{ config('app.name') }}