@if (Route::is('news.index'))
    News 
@elseif(Route::is('news.create'))
    Create New News
@elseif(Route::is('news.edit'))
    Edit News
@endif
    | Admin Panel - 
    {{ config('app.name') }}