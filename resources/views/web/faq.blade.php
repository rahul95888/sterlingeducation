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

<style>

  .active strong{
    color:#fff;
  }
</style>
</head>
<body class="">
   
<div id="wrapper" class="clearfix">
    <!-- HEADER AREA START (header-5) -->
    @include('layouts.webnavigtion')
    <div class="main-content">
  <!-- Start main-content -->
  <div class="main-content">

<!-- Section: inner-header -->
<section class="inner-header divider parallax   bg-orange">
  <div class="container pt-20 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h2 class="title text-black centertext">FAQ</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="accordion1" class="panel-group accordion">
          @foreach($faq as $key=>$value)
          <div class="panel">
            <div class="panel-title"> <a data-parent="#accordion1{{$key}}" data-toggle="collapse" href="#accordion1{{$key}}" class="{{$key==0 ? 'active' : ''}}" aria-expanded="true"> <span class="open-sub"></span> <strong>Q. {{$value->service_name}}</strong></a> </div>
            <div id="accordion1{{$key}}" class="panel-collapse collapse {{$key==0 ? 'in' : ''}}" role="tablist" aria-expanded="true">
              <div class="panel-content">
                <p>{{$value->commodity_uid}}</p>
              </div>
            </div>
          </div>
          @endforeach
           
        </div>
      </div>
    </div>
  </div>
</section>

<!-- divider: what makes us different -->
<section class="divider parallax layer-overlay overlay-white-9" data-parallax-ratio="0.1" data-bg-img="images/bg/bg2.jpg">
  <div class="container">
    <div class="section-content text-center">
      <div class="row">
        <div class="col-md-12">
          <h3 class="mt-0">Did not find your answer?</h3>
          <h2>Just call at <span class="text-theme-color-2">+91 9680410911</span> for any query</h2>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
  <!-- end main-content -->
  
    
@include('layouts.webfooter')
</div>
</body>

</html>
