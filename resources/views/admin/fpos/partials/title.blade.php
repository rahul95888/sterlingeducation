@if (Route::is('fpos.index'))
Testimonial
@elseif(Route::is('fpos.create'))
    Create Testimonial
@elseif(Route::is('fpos.edit'))
    Edit Testimonial
@endif
    | Admin Panel - 
    {{ config('app.name') }}