<?php 
$competative = \App\Models\Course::where(['type'=>'Competitive'])->orderBy('id','DESC')->get();
    $subject = \App\Models\Course::where(['type'=>'Subject'])->orderBy('id','DESC')->get();

?>

  <header id="header" class="header">
    <div class="header-top bg-theme sm-text-center p-0 " style="background:#f47621 ">
    
      <div class="container">
        <div class="row">
          <div class="col-md-4" >
            <div class="widget no-border m-0">
              <ul class="list-inline font-13 sm-text-center mt-5">
                <li>
                  <a class="text-black" href="{{ route('faq') }}"><b style="font-weight:800">FAQ</b></a>
                </li>
                <li class="text-black">|</li>
                <li>
                  <a class="text-black" target="_blank" href="https://sterlingeducation.videocrypt.in/ "><b style="font-weight:800">Online Mock Test</b></a>
                </li>
                <li class="text-black">|</li>
                <li>
                  <a class="text-black" href="https://play.google.com/store/apps/details?id=com.sterlingeducation.edu" target="_blank"><b style="font-weight:800">Download App</b></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-8" >
            
            <div class="widget no-border m-0 mr-15 pull-right flip sm-pull-none sm-text-center">
              <ul class="styled-icons icon-circled icon-sm pull-right flip sm-pull-none sm-text-center mt-sm-15">
                <li><a class='' target="_blank" href="https://www.facebook.com/sterlingeduc"><i class="fa fa-facebook text-black"></i></a></li>
                <li><a class='' target="_blank" href="https://www.youtube.com/channel/UCvTokxJYDpRNDAKsFOyzVyA?view_as=subscriber"><i class="fa fa-youtube text-black"></i></a></li>
                <li><a class='' target="_blank" href="https://www.google.com/maps/place//data=!4m3!3m2!1s0x396db6139f0a8bb9:0xcf28f3d2c60a7300!12e1?source=g.page.default"><i class="fa fa-google-plus text-black"></i></a></li>
                <li><a target="_blank" class='' href="https://www.instagram.com/education.sterling/"><i class="fa fa-instagram text-black"></i></a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-middle p-0 bg-lightest xs-text-center">
      <div class="container pt-0 pb-0">
        <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-5">
            <div class="widget no-border m-0">
              <a class="menuzord-brand pull-left flip xs-pull-center mb-15" href="{{ route('index') }}"><img src="{{URL::to('assets/web/images/logo-wide.png')}}" alt=""></a>
            </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
              <ul class="list-inline">
                <li><i class="fa fa-phone-square text-theme-colored font-36 mt-5 sm-display-block"></i></li>

                <li style="margin-top:35px">
                  <a href="#" class="font-12 text-gray text-uppercase"><b>Call us today!</b></a>
                  <h5 class="font-14 m-0"> <b>+91 9680410911</b></h5>
                </li>
              </ul>
            </div>
          </div>  
          <div class="col-xs-12 col-sm-4 col-md-3">
            <div class="widget no-border pull-right sm-pull-none sm-text-center mt-10 mb-10 m-0">
              <ul class="list-inline">
                <li><i class="fa fa-envelope text-theme-colored font-36 mt-5 sm-display-block"></i></li>
                <li style="margin-top:35px">
                  <a href="#" class="font-12 text-gray text-uppercase"><b>Write us on!</b></a>
                  <h5 class="font-13 text-black m-0">   <b>info@sterlingeducation.co.in</b></h5>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-nav">
      <div class="header-nav-wrapper navbar-scrolltofixed bg-theme-colored border-bottom-theme-color-2-1px">
        <div class="container">
          <nav id="menuzord" class="menuzord bg-theme-colored pull-left flip menuzord-responsive">
            
            <ul class="menuzord-menu">
              <li  @if(Route::is('index')) class="active" @endif><a href="{{ route('index') }}"><b>Home</b></a>
                 
              </li>
              <li @if(Route::is('about')) class="active" @endif><a href="{{ route('about') }}"><b>About us</b></a> </li>
              

              <li @if(Route::is('coursedetail') || Route::is('courselist'))  class="active" @endif>
                <a href="#"><b>Competitive Courses</b></a>
                  <ul class="dropdown">
                   @foreach($competative as $data)
                    <li class=""><a href="{{URL::to('/coursedetail/'.$data->slug)}}"><b>{{$data->title}}</b></a> </li>
                    @endforeach
                  </ul>
              </li>

              <li @if(Route::is('subjectdetail'))  class="active" @endif>
                <a href="#"><b>MBA Courses</b></a>
                  <ul class="dropdown">
                   @foreach($subject as $data)
                    <li class=""><a href="{{URL::to('/subjectdetail/'.$data->slug)}}"><b>{{$data->title}}</b></a> </li>
                    @endforeach
                  </ul>
              </li>



              <li @if(Route::is('gallery') || Route::is('joblist') || Route::is('event') || Route::is('shop') || Route::is('shopDetail') || Route::is('eventDetail') || Route::is('jobDetail'))  class="active" @endif>
                <a href="#"><b>Resources</b></a>
                  <ul class="dropdown">
                    <li class=""><a href="{{ route('gallery') }}"><b>Gallery</b></a> </li>
                    <li class=""><a href="{{ route('joblist') }}"><b>Job</b></a> </li>
                    <li class=""><a href="{{ route('event') }}"><b>Upcoming Batches</b></a> </li>
                    <li class=""><a href="{{ route('shop') }}"><b>Books</b></a> </li>
                    <li class=""><a href="{{ route('blogInfinity') }}"><b>Blogs </b></a> </li>
                    <li class=""><a href="{{ route('downloadlist') }}"><b>Downloads</b></a> </li>
  

                  </ul>
              </li>
              <li @if(Route::is('contact'))  class="active" @endif><a href="{{ route('contact') }}"><b>Contact us</b></a> </li>
              
            </ul>
            
            
          </nav>
        </div>
      </div>
    </div>
  </header>