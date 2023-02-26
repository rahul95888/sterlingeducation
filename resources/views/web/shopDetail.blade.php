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
          <h2 class="title text-black centertext">{{$shop->equipment_name}}</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="product">
          <div class="col-md-5">
            <div class="product-image">
              <div class="zoom-gallery">
                <a href="{{URL::to('uploads/property/'.$shop->thumb)}}" title="Title Here 1"><img src="{{URL::to('uploads/property/'.$shop->thumb)}}" alt=""></a>
              </div>
            </div>
          </div>
          <div class="col-md-7">
            <div class="product-summary">
              <h2 class="product-title"> {{$shop->equipment_name}}</h2>
              
              <div class="price"><ins><span class="amount">₹ {{$shop->lounge}}</span></ins> </div>
              <div class="short-description">
                <p>{{$shop->google_location}}</p>
              </div>
              <button class="single_add_to_cart_button btn btn-theme-colored" type="submit">Know More</button>
                </form>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="horizontal-tab product-tab">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab1" data-toggle="tab">Description</a></li>
                <li><a href="#tab2" data-toggle="tab">Additional Information</a></li>
            
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="tab1">
                  <h3>Product Description</h3>
                  <p>{!! $shop->description  !!}</p>
                </div>
                <div class="tab-pane fade" id="tab2">
                {!! $shop->itinerary !!}
                </div>
              
              </div>
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
