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
          <h2 class="title text-black centertext">BLOGS</h2>
        </div>
      </div>
    </div>
  </div>
</section>
    <!-- Section: Blog -->
    <section>
      <div class="container mt-30 mb-30 pt-30 pb-0">
        <div class="row multi-row-clearfix">
          <div id="blog-posts-wrapper" class="blog-posts">
          @foreach($news as $data)  
            <div class="col-sm-6 col-md-3 col-lg-3">
              <article class="post clearfix maxwidth600 mb-30">
                <div class="entry-header">
                  <div class="post-thumb thumb"> <img src="{{URL::to('/uploads/category/'.$data->image)}}" alt="" class="img-responsive img-fullwidth"> </div>
                </div>
                <div class="entry-content border-1px p-20">
                  <h5 class="entry-title mt-0 pt-0"><a href="{{URL::to('/blog-details/'.$data->slug)}}">{{$data->title}}</a></h5>
                  <ul class="list-inline entry-date font-12 mt-5">
                    <li class="pr-0"><a class="text-theme-colored" href="#">Admin |</a></li>
                    <li class="pl-0"><span class="text-theme-colored">{{date("d M Y", strtotime($data->created_at))}}</span></li>
                  </ul>
                  <p class="text-left mb-20 mt-15 font-13">{!! \Illuminate\Support\Str::limit(strip_tags($data->content), 50) !!}...</p>
                  <a class="btn btn-dark btn-theme-colored btn-xs btn-flat mt-0" href="{{URL::to('/blog-details/'.$data->slug)}}">Read more</a>
                  <div class="clearfix"></div>
                </div>
              </article>
            </div>
            @endforeach
          </div>
          
          <div class="clearfix"></div>
           
          <script>
            $(window).load(function(){
              var $infinityload_container = $('#blog-posts-wrapper');
              $infinityload_container.infinitescroll({
                //debug         : true,
                loading: {
                  finishedMsg: '<i class="fa fa-check"></i>',
                  msgText: '<i class="fa fa-spinner fa-spin"></i>',
                  img: "images/preloaders/1.gif",
                  speed: 'normal'
                },
                state: {
                  isDone: false
                },
                nextSelector: "#load-next-posts a",
                navSelector: "#load-next-posts",
                itemSelector  : "#blog-posts-wrapper > .col-sm-6",
                behavior: 'twitter'
              },
              function( newElements ) {
                $infinityload_container.find('#infscr-loading').remove();
              });
            });
          </script>

        </div>
      </div>
    </section>
  </div>


@include('layouts.webfooter')
</div>
</body>

</html>
