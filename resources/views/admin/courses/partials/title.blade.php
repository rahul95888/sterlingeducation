@if (Route::is('course.index'))
Course
@elseif(Route::is('course.create'))
    Create New Course
@elseif(Route::is('course.edit'))
    Edit Course
@endif
    | Admin Panel - 
    {{ config('app.name') }}