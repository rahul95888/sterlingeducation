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
<link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
<title>Bank PO, Clerk, SSC CGL, CHSL Coaching Institute in Jaipur</title>
<meta name="description" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
<meta name="keyword" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
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
          <h2 class="title text-black  centertext">UPCOMING BATCHES</h2>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Section: Event List -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12 blog-pull-right">



          @foreach($batch as $value)


            <div class="upcoming-events bg-white-f3 mb-20">
              <div class="row">
                <div class="col-sm-4 pr-0 pr-sm-15">
                  <div class="thumb p-15">
                  <img alt="featured project" style="width:300px !important;" src="{{URL::to('uploads/property/'.$value->image)}}" class="img-fullwidth">
                  
                  
                 


                  </div>
                </div>
                <div class="col-sm-4 pl-0 pl-sm-15">
                  <div class="event-details p-15 mt-20">
                    <h4 class="media-heading text-uppercase font-weight-500">{{$value->title}}</h4>
                    <p>{{$value->description}}</p>
                    
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="event-count p-15 mt-15">
                    <ul class="event-date list-inline font-16 text-uppercase mt-10 mb-20">
                      <li class="p-15 mr-5 bg-lightest">   {{ date('d', strtotime($value->startDate)) }}</li>
                      <li class="p-15 mr-5 bg-lightest">   {{ date('m', strtotime($value->startDate)) }}</li>
                      <li class="p-15 mr-5 bg-lightest">   {{ date('Y', strtotime($value->startDate)) }}</li>
                    </ul>
                    <ul>
                      <li class="mb-10 text-theme-colored"><i class="fa fa-clock-o mr-5"></i>{{$value->startTime}}</li>
                      <li class="text-theme-colored"><i class="fa fa-map-marker mr-5"></i> {{$value->location}} Institute</li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
         

            @endforeach



            
          </div>
              </div>
      </div>
    </section>
  </div>
  
@include('layouts.webfooter')
</div>
</body>

</html>
