@if (Route::is('job.index'))
    job
@elseif(Route::is('job.create'))
    Create New job
@elseif(Route::is('job.edit'))
    Edit job
@endif
    | Admin Panel - 
    {{ config('app.name') }}