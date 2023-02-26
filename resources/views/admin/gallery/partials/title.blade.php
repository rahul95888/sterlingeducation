@if (Route::is('gallery.index'))
    Gallery
@elseif(Route::is('gallery.create'))
    Create New Gallery
@elseif(Route::is('gallery.edit'))
    Edit Gallery
@endif
    | Admin Panel - 
    {{ config('app.name') }}