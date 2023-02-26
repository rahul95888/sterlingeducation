sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Sterling Edu</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <?php

#User subadmin Permissions 
use App\Models\Adminrole;
$r1 = Route::getCurrentRoute()->getAction();
$r2 = Route::currentRouteAction();
$r3 = Route::currentRouteName();

$r4 = explode('@',$r2);

$permissions_string = Adminrole::where('role_uid',Auth::user()->role_uid)->value('permissions');

$permissions_array = explode(',', $permissions_string);

#end subadmin Permissions work
?>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <!-- <a href="{{ route('dashboard') }}"><li class="menu-label">Dashboard</li></a> -->
        @if( preg_match('/DashboardController/', $permissions_string) ||$permissions_string == '*')
        <li>
            <a href="{{ route('dashboard') }}">
                <div class="parent-icon"><i class="bx bxs-dashboard"></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        @endif
        @if( preg_match('/FarmerController/', $permissions_string) || preg_match('/FpoController/', $permissions_string) || preg_match('/TraderController/', $permissions_string) || preg_match('/ProcessorController/', $permissions_string)||$permissions_string == '*')
       
        @if( preg_match('/ProcessorController/', $permissions_string) ||$permissions_string == '*')
               
               <li @if(Route::is('processors.index') || Route::is('processors.create') || Route::is('processors.edit')) class="mm-active" @endif> 
                   <a href="{{ route('processors.index') }}"><i class="bx bx-right-arrow-alt"></i>Study Material</a>
               </li>
               @endif
        @endif
         
        <!-- <li @if(Route::is('commodities.index') || Route::is('commodities.create') || Route::is('commodities.edit')) class="mm-active" @endif>
                    <a href="{{ route('commodities.index') }}"><i class="bx bx-right-arrow-alt"></i> Categories</a>
                </li> -->
        
        @if( preg_match('/NewsController/', $permissions_string) ||$permissions_string == '*')
        <!-- <li class="menu-label">News</li> -->
        <li @if(Route::is('news.index') || Route::is('news.create') || Route::is('news.edit')) class="mm-active" @endif>
            <a href="{{ route('news.index') }}">
                <i class="bx bx-right-arrow-alt"></i>News
            </a>
        </li>
        @endif
        @if( preg_match('/PopController/', $permissions_string) ||preg_match('/SectionController/', $permissions_string) ||$permissions_string == '*')
        <!-- <li class="menu-label">POP</li> -->
        @if( preg_match('/PopController/', $permissions_string) ||$permissions_string == '*')
                <li @if(Route::is('pops.index') || Route::is('pops.create') || Route::is('pops.edit')) class="mm-active" @endif>
                    <a href="{{ route('pops.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Slider

                     </a>
                </li>

                <li @if(Route::is('services.index') || Route::is('services.create') || Route::is('services.edit')) class="mm-active" @endif>
                    <a href="{{ route('services.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Faq

                     </a>
                </li>

                <li @if(Route::is('fpos.index') || Route::is('fpos.create') || Route::is('fpos.edit')) class="mm-active" @endif>
                    <a href="{{ route('fpos.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Testimonials

                     </a>
                </li>

                <li @if(Route::is('sections.index') || Route::is('sections.create') || Route::is('sections.edit')) class="mm-active" @endif>
                    <a href="{{ route('sections.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Static Pages

                     </a>
                </li>


                <li @if(Route::is('teacher.index') || Route::is('teacher.create') || Route::is('teacher.edit')) class="mm-active" @endif>
                    <a href="{{ route('teacher.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Teacher

                     </a>
                </li>
                <li @if(Route::is('job.index') || Route::is('job.create') || Route::is('job.edit')) class="mm-active" @endif>
                    <a href="{{ route('job.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Job

                     </a>
                </li>

                <li @if(Route::is('course.index') || Route::is('course.create') || Route::is('course.edit')) class="mm-active" @endif>
                    <a href="{{ route('course.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Course

                     </a>
                </li>


                <li @if(Route::is('batch.index') || Route::is('batch.create') || Route::is('batch.edit')) class="mm-active" @endif>
                    <a href="{{ route('batch.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Upcoming Batch

                     </a>
                </li>

                <li @if(Route::is('gallery.index') || Route::is('gallery.create') || Route::is('gallery.edit')) class="mm-active" @endif>
                    <a href="{{ route('gallery.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Gallery

                     </a>
                </li>

                <li @if(Route::is('downloads.index') || Route::is('downloads.create') || Route::is('downloads.edit')) class="mm-active" @endif>
                    <a href="{{ route('downloads.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Downloads

                     </a>
                </li>


                <li @if(Route::is('mocktest.index') || Route::is('mocktest.create') || Route::is('mocktest.edit')) class="mm-active" @endif>
                    <a href="{{ route('mocktest.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage MockTest

                     </a>
                </li>


                <li @if(Route::is('videolesson.index') || Route::is('videolesson.create') || Route::is('videolesson.edit')) class="mm-active" @endif>
                    <a href="{{ route('videolesson.index') }}">
                    <i class="bx bx-right-arrow-alt"></i>Manage Video Lesson

                     </a>
                </li>

                @endif
        @endif
 
        <!-- <li class="menu-label">Location</li> -->
        </ul>
    
    <!--end navigation-->
</div>
<!--end sidebar wrapper 