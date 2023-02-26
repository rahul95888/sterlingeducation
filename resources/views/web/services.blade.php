<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta name="viewport" content="width=device-width,initial-scale=1.0" />
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		 



        <link rel="icon" type="image/png" href="assets/web/images/favicon.png">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/web/vendors/bootstrap/css/bootstrap.min.css" media="all">
      <!-- jquery-ui css -->
      <link rel="stylesheet" type="text/css" href="assets/web/vendors/jquery-ui/jquery-ui.min.css">
      <!-- fancybox box css -->
      <link rel="stylesheet" type="text/css" href="assets/web/vendors/fancybox/dist/jquery.fancybox.min.css">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="assets/web/vendors/fontawesome/css/all.min.css">
      <!-- Elmentkit Icon CSS -->
      <link rel="stylesheet" type="text/css" href="assets/web/vendors/elementskit-icon-pack/assets/css/ekiticons.css">
      <!-- slick slider css -->
      <link rel="stylesheet" type="text/css" href="assets/web/vendors/slick/slick.css">
      <link rel="stylesheet" type="text/css" href="assets/web/vendors/slick/slick-theme.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&amp;display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="assets/web/style.css">
      <link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
      <title>Bank PO, Clerk, SSC CGL, CHSL Coaching Institute in Jaipur</title>
<meta name="description" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
<meta name="keyword" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
	</head>
    <body>
     

<!-- Body main wrapper start -->
<div id="page" class="page">

    <!-- HEADER AREA START (header-5) -->
    @include('layouts.webnavigtion')
    <main id="content" class="site-main">
            <section class="service-inner-page inner-page-wrap">
               <!-- ***Inner Banner html start form here*** -->
               <div class="inner-banner-wrap">
                  <div class="inner-baner-container" style="background-image: url(assets/web/images/img7.jpg);">
                     <div class="container">
                        <div class="inner-banner-content">
                           <h1 class="page-title">Services</h1>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- ***Inner Banner html end here*** -->
               <!-- ***about section html start form here*** -->
               <div class="inner-service-wrap">
                  <div class="container">
                     <div class="row">
                     @foreach($Services as $value)
                        <div class="col-lg-4 col-sm-6">
                           <div class="icon-box bg-img-box" style="background-image: url({{url('/uploads/property/'.$value->image)}});">
                              <div class="box-icon">
                                 <i class="fas fa-hotel"></i>
                              </div>
                              <div class="icon-box-content">
                                 <h3>{{$value->service_name}}</h3>
                                 {!! $value->commodity_uid !!}
                                 <a href="{{url('/service-details/'.$value->id)}}" class="round-btn">View More</a>
                              </div>
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>
               </div>
               <!-- ***about section html start form here*** -->
               <!-- ***callback section html start form here*** -->
               <div class="bg-color-callback bg-light-grey">
                  <div class="container">
                     <div class="row align-items-center">
                        <div class="col-lg-8 offset-lg-2 text-center">
                           <h5 class="sub-title">CALL TO ACTION</h5>
                           <h2 class="section-title">READY FOR UNFORGATABLE TRAVEL. REMEMBER US!</h2>
                           <p>Fusce hic augue velit wisi quibusdam pariatur, iusto primis, nec nemo, rutrum. Vestibulum cumque laudantium. Sit ornare mollitia tenetur, aptent.</p>
                            


                           <div class="callback-btn">
                    <a href="{{URL::to('/our-packages')}}" class="round-btn">View Packages</a>
                    <a href="{{URL::to('/about')}}" class="outline-btn"
                      >Learn More</a
                    >
                  </div>


                        </div>
                     </div>
                  </div>
               </div>
               <!-- ***callback section html end here*** -->
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
