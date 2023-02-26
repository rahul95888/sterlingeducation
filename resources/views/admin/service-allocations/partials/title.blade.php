@if (Route::is('service-allocations.index'))
    Service Allocations
@elseif(Route::is('service-allocations.create'))
    Create New Service Allocation
@elseif(Route::is('service-allocations.edit'))
    Edit Service Allocation
@endif
    | Admin Panel - 
    {{ config('app.name') }}