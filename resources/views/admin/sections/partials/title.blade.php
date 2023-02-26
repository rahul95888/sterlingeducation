@if (Route::is('sections.index'))
    Sections 
@elseif(Route::is('sections.create'))
    Create New Section
@elseif(Route::is('sections.edit'))
    Edit Section
@endif
    | Admin Panel - 
    {{ config('app.name') }}