@if (Route::is('videolesson.index'))
    Video Lesson
@elseif(Route::is('videolesson.create'))
    Create New Video Lesson
@elseif(Route::is('videolesson.edit'))
    Edit Video Lesson
@endif
    | Admin Panel - 
    {{ config('app.name') }}