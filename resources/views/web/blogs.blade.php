 

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
      <link rel="stylesheet" type="text/css" href="{{URL::to('assets/web/style.css')}}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
	</head>
    <body>
    <!--[if lte IE 9]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->

    <!-- Add your site or application content here -->

<!-- Body main wrapper start -->
<div class="body-wrapper">
    @include('layouts.webnavigtion')
    
    <main id="content" class="site-main">
            <div class="inner-banner-wrap">
               <div class="inner-baner-container" 
               style="background-image: url({{url('assets/web/images/img7.jpg')}});"
               >
                  <div class="container">
                     <div class="inner-banner-content">
                        <h1 class="page-title centertext">OUR BLOGS</h1>
                     </div>
                  </div>
               </div>
            </div>
            
            <div class="archive-section blog-archive">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-12 primary right-sidebar">
                        <!-- blog post item html start -->
                        <div class="grid blog-inner row">
                        @foreach($news as $data)  
                        <div class="grid-item col-md-4">
                              <article class="post">
                                 <figure class="featured-post">

                                 

                                    <img src="{{URL::to('/uploads/category/'.$data->image)}}" alt="">
                                 </figure>
                                 <div class="post-content">
                                    <div class="cat-meta">
                                       <a href="{{URL::to('/blog-details/'.$data->slug)}}">TOUR</a>
                                    </div>
                                    <h3><a href="{{URL::to('/blog-details/'.$data->slug)}}">{{$data->title}}</a></h3>
                                    <p> {!! \Illuminate\Support\Str::limit(html_entity_decode($data->content), 50) !!}...</p>
                                    <div class="post-footer d-flex justify-content-between align-items-center">
                                       <div class="post-btn">
                                          <a href="{{URL::to('/blog-details/'.$data->slug)}}" class="round-btn">Read More</a>
                                       </div>
                                       
                                    </div>
                                 </div>
                              </article>
                           </div>
                        @endforeach

                           
                           
                           
                          
                            
                        </div>
                        
                        
                     </div>
                     <!-- <div class="col-lg-4 secondary">
                        <div class="sidebar">
                            
                           <aside class="widget widget_latest_post widget-post-thumb">
                              <h3 class="widget-title">Recent Post</h3>
                              <ul>
                                 <li>
                                    <figure class="post-thumb">
                                       <a href="blog-single.html"><img src="assets/web/images/img4.jpg" alt=""></a>
                                    </figure>
                                    <div class="post-content">
                                       <h5>
                                          <a href="blog-single.html">BEST JOURNEY TO PEACEFUL PLACES</a>
                                       </h5>
                                       <div class="entry-meta">
                                          <span class="posted-on">
                                             <a href="blog-single.html">August 17, 2021</a>
                                          </span>
                                          <span class="comments-link">
                                             <a href="blog-single.html">No Comments</a>
                                          </span>
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <figure class="post-thumb">
                                       <a href="blog-single.html"><img src="assets/web/images/img5.jpg" alt=""></a>
                                    </figure>
                                    <div class="post-content">
                                       <h5>
                                          <a href="blog-single.html">BTRAVEL WITH FRIENDS IS BEST</a>
                                       </h5>
                                       <div class="entry-meta">
                                          <span class="posted-on">
                                             <a href="blog-single.html">August 17, 2021</a>
                                          </span>
                                          <span class="comments-link">
                                             <a href="blog-single.html">No Comments</a>
                                          </span>
                                       </div>
                                    </div>
                                 </li>
                                 <li>
                                    <figure class="post-thumb">
                                       <a href="blog-single.html"><img src="assets/web/images/img6.jpg" alt=""></a>
                                    </figure>
                                    <div class="post-content">
                                       <h5>
                                          <a href="blog-single.html">SANTORINI ISLAND'S WEEKEND</a>
                                       </h5>
                                       <div class="entry-meta">
                                          <span class="posted-on">
                                             <a href="blog-single.html">August 17, 2021</a>
                                          </span>
                                          <span class="comments-link">
                                             <a href="blog-single.html">No Comments</a>
                                          </span>
                                       </div>
                                    </div>
                                 </li>
                              </ul>
                           </aside>
                           <aside class="widget widget_adds">
                              <figure>
                                 <img src="assets/web/images/add-banner.jpg">
                              </figure>
                           </aside>
                           <aside class="widget widget_category">
                              <h3 class="widget-title">Categories</h3>
                              <ul>
                              @foreach($category as $data)
                                 <li>
                                    <i aria-hidden="true" class="fas fa-dot-circle"></i>
                                    <a href="#">{{$data->name}}</a>
                                    <span>(3)</span>
                                 </li>
                                 @endforeach
                                 
                              </ul>
                           </aside>
                        </div>
                     </div> -->
                  </div>
               </div>
            </div>
         </main>
    @include('layouts.webfooter')
    <!-- FOOTER AREA END -->

</div>
 
  
</body>
</html>
