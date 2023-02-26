@if (Route::is('teacher.index'))
    Teacher
@elseif(Route::is('teacher.create'))
    Create New Teacher
@elseif(Route::is('teacher.edit'))
    Edit Teacher
@endif
    | Admin Panel - 
    {{ config('app.name') }}