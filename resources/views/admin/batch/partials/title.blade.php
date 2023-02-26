@if (Route::is('batch.index'))
Batch
@elseif(Route::is('batch.create'))
    Create Batch
@elseif(Route::is('batch.edit'))
    Edit Batch
@endif
    | Admin Panel - 
    {{ config('app.name') }}