@if (Route::is('feedbacks.index'))
    Feedback Report
@elseif(Route::is('feedbacks.create'))
    Create New Feedback
@elseif(Route::is('feedbacks.edit'))
    Edit Feedback
@endif
    | Admin Panel - 
    {{ config('app.name') }}