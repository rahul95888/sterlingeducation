<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<!-- Stylesheet -->
<link href="{{URL::to('assets/web/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{URL::to('assets/web/css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{URL::to('assets/web/css/animate.css')}}" rel="stylesheet" type="text/css">
<link href="{{URL::to('assets/web/css/css-plugin-collections.css')}}" rel="stylesheet"/>
<!-- CSS | menuzord megamenu skins -->
<link id="menuzord-menu-skins" href="{{URL::to('assets/web/css/menuzord-skins/menuzord-rounded-boxed.css')}}" rel="stylesheet"/>
<!-- CSS | Main style file -->
<link href="{{URL::to('assets/web/css/style-main.css')}}" rel="stylesheet" type="text/css">
<!-- CSS | Preloader Styles -->
<link href="{{URL::to('assets/web/css/preloader.css')}}" rel="stylesheet" type="text/css">
<!-- CSS | Custom Margin Padding Collection -->
<link href="{{URL::to('assets/web/css/custom-bootstrap-margin-padding.css')}}" rel="stylesheet" type="text/css">
<!-- CSS | Responsive media queries -->
<link href="{{URL::to('assets/web/css/responsive.css')}}" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
<!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

<!-- Revolution Slider 5.x CSS settings -->
<link  href="{{URL::to('assets/web/js/revolution-slider/css/settings.css')}}" rel="stylesheet" type="text/css"/>
<link  href="{{URL::to('assets/web/js/revolution-slider/css/layers.css')}}" rel="stylesheet" type="text/css"/>
<link  href="{{URL::to('assets/web/js/revolution-slider/css/navigation.css')}}" rel="stylesheet" type="text/css"/>

<!-- CSS | Theme Color -->
<link href="{{URL::to('assets/web/css/colors/theme-skin-color-set-1.css')}}" rel="stylesheet" type="text/css">

<!-- external javascripts -->
<script src="{{URL::to('assets/web/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{URL::to('assets/web/js/jquery-ui.min.js')}}"></script>
<script src="{{URL::to('assets/web/js/bootstrap.min.js')}}"></script>
<!-- JS | jquery plugin collection for this theme -->
<script src="{{URL::to('assets/web/js/jquery-plugin-collection.js')}}"></script>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="{{URL::to('assets/web/js/revolution-slider/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{URL::to('assets/web/js/revolution-slider/js/jquery.themepunch.revolution.min.js')}}"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
</head>
<body class="">
<div id="wrapper" class="clearfix">
    <!-- HEADER AREA START (header-5) -->
    @include('layouts.webnavigtion')
    
    <div class="main-content">
    <!-- Section: inner-header -->
    <section class="inner-header divider parallax   bg-orange">
  <div class="container pt-20 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h2 class="title text-black centertext">COMPETITIVE COURSES</h2>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Section: Course list -->
    <section>
      <div class="container">
        <div style="display:flex">
          <div class="col-md-9 blog-pull-right">
            @foreach($courselist as $value)
            <div class="row mb-15">
              <div class="col-sm-6 col-md-4">
                <div class="thumb"> <img alt="featured project" src="{{URL::to('uploads/property/'.$value->image)}}" class="img-fullwidth"></div>
              </div>
              <div class="col-sm-6 col-md-8">
                <h4 class="line-bottom mt-0 mt-sm-20">{{$value->title}}</h4>
                <ul class="review_text list-inline">
                  <li><h4 class="mt-0"><span class="text-theme-color-2">Price : </span> ₹ {{$value->price}}/-</h4></li>
                  
                </ul>
                <p>{!! \Illuminate\Support\Str::limit(strip_tags($value->description), 150) !!}</p>
                <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" 
                href="{{URL::to('/coursedetail/'.$value->slug)}}">view details</a>
              </div>
            </div>
            
            @endforeach





          </div>
          
          <div class="col-md-3">
            <div class="sidebar sidebar-left mt-sm-30">
              <div class="widget">
                <h5 class="widget-title line-bottom">Search <span class="text-theme-color-2">Courses</span></h5>
                <div class="search-form">
                  <form>
                    <div class="input-group">
                      <input type="text" placeholder="Click to Search" class="form-control search-input">
                      <span class="input-group-btn">
                      <button type="submit" class="btn search-button"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>
              </div>
               
              <div class="widget">
                <h5 class="widget-title line-bottom">Latest <span class="text-theme-color-2">Courses</span></h5>
                <div class="latest-posts">
                  @foreach($latest as $value)
                  <article class="post media-post clearfix pb-0 mb-10">
                    <a class="post-thumb" href="#"><img src="images/services/s1.jpg" alt=""></a>
                    <div class="post-right">
                      <h5 class="post-title mt-0"><a href="{{URL::to('/coursedetail/'.$value->id)}}">{{$value->title}}</a></h5>
                      
                    </div>
                  </article>
                  @endforeach
                  
                </div>
              </div>
             
            </div>
          </div>
        </div>
     
      </div>
    </section>
  </div>
  
    @include('layouts.webfooter')
</div>
</body>

</html>
