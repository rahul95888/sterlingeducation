<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		 



        <link rel="icon" type="image/png" href="{{URL::to('assets/web/images/favicon.png')}}">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{URL::to('assets/web/vendors/bootstrap/css/bootstrap.min.css')}}" media="all">
      <!-- jquery-ui css -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/jquery-ui/jquery-ui.min.css')}}">
      <!-- fancybox box css -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/fancybox/dist/jquery.fancybox.min.css')}}">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/fontawesome/css/all.min.css')}}">
      <!-- Elmentkit Icon CSS -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/elementskit-icon-pack/assets/css/ekiticons.css')}}">
      <!-- slick slider css -->
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/slick/slick.css')}}">
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/vendors/slick/slick-theme.css')}}">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/style.css')}}">
      <title>Bank PO, Clerk, SSC CGL, CHSL Coaching Institute in Jaipur</title>
<meta name="description" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
<meta name="keyword" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
	</head>
    <body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div id="page" class="page">

    <!-- HEADER AREA START (header-5) -->
    @include('layouts.webnavigtion')
    <main id="content" class="site-main">
            <section class="inner-page-wrap">
               <!-- ***Inner Banner html start form here*** -->
               <div class="inner-banner-wrap">
                  <div class="inner-baner-container" style="background-image: url({{url('assets/web/images/img7.jpg')}});">
                     <div class="container">
                        <div class="inner-banner-content">
                           <h1 class="page-title">{{$data[0]->name}}</h1>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="inner-about-wrap">
                  <div class="container">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="about-content">
                               
                              
                           {!! html_entity_decode($data[0]->section_content) !!}
                              
                           </div>
                            
                        </div>
                         
                     </div>
                  </div>
               </div>
               
            </section>
         </main>

    @include('layouts.webfooter')

</div>
<!-- Body main wrapper end -->

    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div class="spinner">
                <div class="dot1"></div>
                <div class="dot2"></div>
            </div>
        </div>
    </div>
    <!-- preloader area end -->

    <!-- All JS Plugins -->
    <script src="js/plugins.js"></script>
    <!-- Main JS -->
    <script src="js/main.js"></script>
  
</body>
</html>
