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
          <h2 class="title text-black centertext">MOCK TEST</h2>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="">
  <div class="container">
    <div class="section-content">
      <div class="row">
        <div class="col-sm-12 col-md-12">
          
          <div class="row multi-row-clearfix">
            <div class="products">

            @foreach($mocktest as $key=>$value)

              <div class="col-sm-6 col-md-4 col-lg-3 mb-30">
                <div class="product">
                  <div class="product-thumb"> 
                    <img alt="" src="{{URL::to('uploads/property/'.$value->thumb)}}" class="img-responsive img-fullwidth">
                    <div class="overlay">
                      
                      <div class="btn-product-view-details">
                        <a class="btn btn-default btn-theme-colored btn-sm btn-flat pl-20 pr-20 btn-add-to-cart text-uppercase font-weight-700" href="{{ URL('/mock-test-detail/'.$value->slug) }}">View detail</a>
                      </div>
                    </div>
                  </div>
                  <div class="product-details text-center">
                 
                    <a href="#"><h5 class="product-title"> {{$value->title}}</h5></a>
                    
                    <div class="price"><ins><span class="amount">₹ {{$value->amount}}</span></ins></div>
                  </div>
                </div>
              </div>

              @endforeach

            </div>
          </div>
        </div>
        <!-- <div class="col-sm-12 col-md-3">
          <div class="sidebar sidebar-right mt-sm-30">
            <div class="widget">
              <h5 class="widget-title line-bottom">Search box</h5>
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
              <h5 class="widget-title line-bottom">Categories</h5>
              <div class="categories">
                <ul class="list list-border angle-double-right">
                  <li><a href="#">Creative<span>(19)</span></a></li>
                  <li><a href="#">Portfolio<span>(21)</span></a></li>
                  <li><a href="#">Fitness<span>(15)</span></a></li>
                  <li><a href="#">Gym<span>(35)</span></a></li>
                  <li><a href="#">Personal<span>(16)</span></a></li>
                </ul>
              </div>
            </div>
           
             
          </div>
        </div> -->
      </div>
       
    </div>
  </div>
</section>
</div>


@include('layouts.webfooter')
</div>
</body>

</html>
