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
               <div class="package-inner-page">
                  <div class="inner-baner-container" style="background-image: url({{url('assets/web/images/img7.jpg')}});">
                     <div class="container">
                        <div class="inner-banner-content">
                           <h1 class="page-title">Tour Packages</h1>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ***Inner Banner html end here*** -->
               <!-- ***package section html start form here*** -->
               <div class="package-item-wrap">
                  <div class="container">
                     @foreach($data as $value)
                     <article class="package-item">
                        <figure class="package-image" style="background-image: url({{url('/uploads/property/'.$value->thumb)}});"></figure>
                        <div class="package-content">
                           <h3>
                           

                           <a href="{{URL::to('/package-details/'.$value->id)}}">
                                {{$value->equipment_name}}
                              </a>
                           </h3>
                           <p> {!! \Illuminate\Support\Str::limit(html_entity_decode($value->description), 50) !!}</p>
                           <div class="package-meta">
                              <ul>
                                 <li>
                                    <i class="fas fa-clock"></i>
                                    {{$value->bedroom}}
                                 </li>
                                 <li>
                                    <i class="fas fa-user-friends"></i>
                                    pax: {{$value->total_area}}
                                 </li>
                                 <li>
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{$value->google_location}}
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="package-price">
                            
                           <h6 class="price-list">
                              <span>${{$value->lounge}}</span>
                              / per person
                           </h6>
                           <a href="{{URL::to('/contact')}}" class="outline-btn outline-btn-white">Book now</a>
                        </div>
                     </article>
                     @endforeach
                     
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
