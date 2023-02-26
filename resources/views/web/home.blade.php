<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta name="viewport" content="width=device-width,initial-scale=1.0" />
<link href="{{URL::to('assets/web/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/web/css/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/web/css/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('assets/web/css/css-plugin-collections.css')}}" rel="stylesheet" />
    <!-- CSS | menuzord megamenu skins -->
    <link
      id="menuzord-menu-skins"
      href="{{URL::to('assets/web/css/menuzord-skins/menuzord-rounded-boxed.css')}}"
      rel="stylesheet"
    />
    <!-- CSS | Main style file -->
    <link href="{{URL::to('assets/web/css/style-main.css')}}" rel="stylesheet" type="text/css" />
    <!-- CSS | Preloader Styles -->
    <link href="{{URL::to('assets/web/css/preloader.css')}}" rel="stylesheet" type="text/css" />
    <!-- CSS | Custom Margin Padding Collection -->
    <link
      href="{{URL::to('assets/web/css/custom-bootstrap-margin-padding.css')}}"
      rel="stylesheet"
      type="text/css"
    />
    <!-- CSS | Responsive media queries -->
    <link href="{{URL::to('assets/web/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->
    <!-- <link href="css/style.css" rel="stylesheet" type="text/css"> -->

    <!-- Revolution Slider 5.x CSS settings -->
    <link href="{{URL::to('assets/web/css/responsive.css')}}" rel="stylesheet" type="text/css">
 
<link  href="{{URL::to('assets/web/js/revolution-slider/css/settings.css')}}" rel="stylesheet" type="text/css"/>
<link  href="{{URL::to('assets/web/js/revolution-slider/css/layers.css')}}" rel="stylesheet" type="text/css"/>
<link  href="{{URL::to('assets/web/js/revolution-slider/css/navigation.css')}}" rel="stylesheet" type="text/css"/>

 
<link href="{{URL::to('assets/web/css/colors/theme-skin-color-set-1.css')}}" rel="stylesheet" type="text/css">
    <!-- external javascripts -->   
    <!-- JS | jquery plugin collection for this theme -->
<script src="{{URL::to('assets/web/js/jquery-2.2.4.min.js')}}"></script>
<script src="{{URL::to('assets/web/js/jquery-ui.min.js')}}"></script>

<script src="{{URL::to('assets/web/js/jquery-plugin-collection.js')}}"></script>
    <!-- Revolution Slider 5.x SCRIPTS -->
<script src="{{URL::to('assets/web/js/revolution-slider/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{URL::to('assets/web/js/revolution-slider/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  
   

    <script src="{{URL::to('assets/web/js/bootstrap.min.js')}}"></script>
    <link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
<title>Bank PO, Clerk, SSC CGL, CHSL Coaching Institute in Jaipur</title>
<meta name="description" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
<meta name="keyword" content="Our results say everything about us and it makes Sterling Education as one of the best coaching institute for Bank PO, Clerk, SSC CGL, CHSL exams in Jaipur.">
<style>
      .tp-revslider-mainul{
        height:80vh !important;
      }
</style>
</head>
<body class="">
<div id="wrapper" class="clearfix">
@include('layouts.webnavigtion')
<div class="main-content">
   <section id="home">
     <div class="container-fluid p-0">
     <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
      @foreach($slider as $key=>$value)
        <li data-target="#myCarousel" data-slide-to="{{$key}}" class="@if($key==0)active @endif"></li>
        @endforeach
        
      </ol>
      <div class="carousel-inner" role="listbox">

      @foreach($slider as $key=>$value)
    <div class="item @if($key==0)active @endif">
      <img class="d-block" style="width:100%;" src="{{URL::to('uploads/property/'.$value->image)}}" alt="First slide">
    </div>
    @endforeach


        
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    




     

       
       <!-- <div class="rev_slider_wrapper">
         <div class="rev_slider" data-version="5.0">
           <ul>
            @foreach($slider as $key=>$value)
            <li data-index="rs-{{$key}}" data-transition="slidingoverlayhorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-thumb="{{URL::to('uploads/property/'.$value->image)}}" data-rotate="0" data-saveperformance="off" data-title="Slide 1" data-description=""><img src="{{URL::to('uploads/property/'.$value->image)}}"  alt=""  data-bgposition="center 5%" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-bgparallax="10" data-no-retina>
          </li>
            @endforeach
          </ul>
         </div>
       </div> -->
     </div>
   </section>
   <section class="">
     <div class="container">
       <div class="section-content">
         <div class="row">
           <div class="col-md-6">
             <h6 class="letter-space-4 text-gray-darkgray text-uppercase mt-0 mb-0">All About</h6>
             <h2 class="text-uppercase font-weight-600 mt-0 font-28 line-bottom">WHY STERLING EDUCATION</h2>
             <h4 class="text-theme-colored">
             <p>Hold your feet and take a moment to realize that Sterling Education which is best bank exams coaching in Jaipur is a one stop destination to crack competitive exams and secure your position in Government sectors under the guidance of experienced faculties. It is an excellent coaching institute for budding candidates seeking for Best Bank PO, Clerk, SBI PO, SBI Clerk, SSC CGL, SSC CHSL, SSC CPO, Insurance and Railways exams coaching in Jaipur.</p>
             
             <a class="btn btn-theme-colored btn-flat btn-lg mt-10 mb-sm-30" href="{{ route('about') }}">Know More →</a>
           </div>
           <div class="col-md-6">
             <div class="video-popup">                
                
                 <img alt="" src="{{URL::to('assets/web/images/about/5.jpg')}}" class="img-responsive img-fullwidth">
                
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>

   
   <section class="bg-lighter">
     <div class="container pb-60">
       <div class="section-title mb-10">
       <div class="row">
         <div class="col-md-8">
           <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Our <span class="text-theme-color-2 font-weight-400">COURSES</span></h2>
        </div>
       </div>
       </div>
       <div class="section-content">




         <div class="row">
           <div class="col-md-12">
             <div class="owl-carousel-5col" data-dots="true">
              @foreach($course as $value)
               <div class="item ">
                 <div class="service-block bg-white">
                   
                 
                 <div class="thumb"> <img alt="featured project" src="{{URL::to('uploads/property/'.$value->image)}}" class="img-fullwidth">


                   <h4 class="text-white mt-0 mb-0"><span class="price">₹ {{$value->price}}/-</span></h4>
                   </div>
                   <div class="content text-left flip p-25 pt-0">
                     <h4 class="line-bottom mb-10">{{$value->title}}</h4>
                     <p>{!! \Illuminate\Support\Str::limit(strip_tags($value->description), 100) !!}</p>

                     @if($value->type=="Subject")
                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="{{URL::to('/subjectdetail/'.$value->slug)}}">view details</a>
                    @else
                    <a class="btn btn-dark btn-theme-colored btn-sm text-uppercase mt-10" href="{{URL::to('/coursedetail/'.$value->slug)}}">view details</a>
                    @endif
                   </div>
                 </div>
               </div>
               @endforeach
               
             </div>
           </div>
         </div>
        </div>
     </div>
   </section>

 
   <section class="divider parallax layer-overlay overlay-theme-colored-9" data-bg-img="{{URL::to('assets/web/images/bg/bg3.jpg')}}" data-parallax-ratio="0.7">
     <div class="container">
       <div class="row">

       <div
                    class="col-sm-6 col-md-4 wow fadeInLeft"
                    data-wow-duration="1s"
                    data-wow-delay="0.3s"
                  >
                    <div class="icon-box text-center pl-0 pr-0 mb-0">
                      <a
                        href="{{ route('videolesson') }}"
                        class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-md"
                      >
                        <i class="pe-7s-video text-white"></i>
                      </a>
                      <h4
                        class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase"
                      >
                        <strong class='text-white'>Video Courses</strong>
                      </h4>
                    </div>
                  </div>
                  <div
                    class="col-sm-6 col-md-4 wow fadeInLeft"
                    data-wow-duration="1s"
                    data-wow-delay="0.3s"
                  >
                    <div class="icon-box text-center pl-0 pr-0 mb-0">
                      <a
                        href="{{ route('mocktest') }}"
                        class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-md"
                      >
                        <i class="pe-7s-timer text-white"></i>
                      </a>
                      <h4
                        class="icon-box-title mt-15 mb-10 letter-space-4 text-uppercase"
                      >
                        <strong class='text-white'>Mock Tests</strong>
                      </h4>
                    </div>
                  </div>
                  <div
                    class="col-sm-6 col-md-4 wow fadeInLeft"
                    data-wow-duration="1s"
                    data-wow-delay="0.3s"
                  >
                    <div class="icon-box text-center pl-0 pr-0 mb-0">
                      <a
                        href="{{ route('shop') }}"
                        class="icon bg-theme-color-2 icon-circled icon-border-effect effect-circle icon-md"
                      >
                        <i class="pe-7s-notebook text-white"></i>
                      </a>
                      <h4
                        class="icon-box-title mt-15 mb-0 letter-space-4 text-uppercase"
                      >
                        <strong class='text-white'>BOOKS</strong>
                      </h4>
                    </div>
                  </div>
                </div>
     </div>
   </section>
   <section id="gallery" class="bg-lighter">
    <div class="container">
       <div class="section-title mb-10">
         <div class="row">
           <div class="col-md-12">
             <h2 class="mt-0 text-uppercase text-theme-colored title line-bottom line-height-1">Our<span class="text-theme-color-2 font-weight-400"> Gallery</span></h2>
           </div>
         </div>
       </div>
       <div class="section-content">
         <div class="row">
           <div class="col-md-12">
             
             <div id="grid" class="gallery-isotope grid-4 gutter clearfix">
              
             @foreach($gallery as $value)

               <div class="gallery-item select1">
                 <div class="thumb">
                   <img class="img-fullwidth" src="{{URL::to('uploads/property/'.$value->image)}}" alt="project">
                   <div class="overlay-shade"></div>
                   <div class="icons-holder">
                     <div class="icons-holder-inner">
                       <div class="styled-icons icon-sm icon-dark icon-circled icon-theme-colored">
                         <a data-lightbox="image" href="{{URL::to('uploads/property/'.$value->image)}}"><i class="fa fa-plus"></i></a>
                          
                       </div>
                     </div>
                   </div>
                   
                 </div>
               </div>
              
               @endforeach

             </div>
         
           </div>
         </div>
       </div>
     </div >
   </section>
    
    <section class="divider parallax layer-overlay overlay-theme-colored-9" data-background-ratio="0.5" data-bg-img="{{URL::to('assets/web/images/bg/bg2.jpg')}}">
     <div class="container pb-50">
       <div class="section-title">
         <div class="row">
           <div class="col-md-8">
             <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1 text-white">Our <span class="text-theme-color-2 font-weight-400">Teachers</span></h2>
          </div>
         </div>
       </div>
       <div class="section-content">
         <div class="row multi-row-clearfix">
          @if(count($teacher)>2)
          @foreach($teacher as $value)
           <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
             <div class="team maxwidth400">
               <div class="thumb"><img class="img-fullwidth" src="{{URL::to('uploads/property/'.$value->image)}}" alt=""></div>
               <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix">
                 <h4 class="name text-theme-color-2 mt-0">{{$value->teacher_name}} - <small>{{$value->subtitle}}</small></h4>
                 <p class="mb-20">{!! \Illuminate\Support\Str::limit(html_entity_decode($value->description), 80) !!}</p>
                 <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                 </ul>
                 <a class="btn btn-theme-colored btn-sm pull-right flip" 
                 href="{{ URL::to('teacherdetail/'.$value->id) }}">VIEW DETAILS</a>
               </div>
             </div>
           </div>
           @endforeach
           @endif


           @if(count($teacher)<=2)
           <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30"></div>
          @foreach($teacher as $value)
           <div class="col-sm-6 col-md-3 sm-text-center mb-sm-30">
             <div class="team maxwidth400">
               <div class="thumb"><img class="img-fullwidth" src="{{URL::to('uploads/property/'.$value->image)}}" alt=""></div>
               <div class="content border-1px border-bottom-theme-color-2-2px p-15 bg-light clearfix">
                 <h4 class="name text-theme-color-2 mt-0">{{$value->teacher_name}} - <small>{{$value->subtitle}}</small></h4>
                 <p class="mb-20">{!! \Illuminate\Support\Str::limit(html_entity_decode($value->description), 80) !!}</p>
                 <ul class="styled-icons icon-dark icon-circled icon-theme-colored icon-sm pull-left flip">
                 </ul>
                 <a class="btn btn-theme-colored btn-sm pull-right flip" 
                 href="{{ URL::to('teacherdetail/'.$value->id) }}">VIEW DETAILS</a>
               </div>
             </div>
           </div>
           @endforeach
           @endif


            
         </div>
       </div>
     </div>
   </section>

    
   
   <section id="event" class="">
     <div class="container pb-50">
       <div class="section-content">
         <div class="row">
           <div class="col-md-6">
             <h2 class="text-uppercase line-bottom mt-0 line-height-1"><i class="fa fa-calendar mr-10"></i>Upcoming <span class="text-theme-color-2"> Batches</span></h2>


             @foreach($batch as $value)


             <article class="post media-post clearfix pb-0 mb-10">
               <a href="{{ route('event') }}" class="post-thumb mr-20">
               <div class="thumb"> 
                
               <img alt="featured project" style="width:200px !important;" src="{{URL::to('uploads/property/'.$value->image)}}" class="img-fullwidth">
                
               </a>
               <div class="post-right">
                 <h4 class="mt-0 mb-5"><a href="{{ route('event') }}">{{$value->title}}</a></h4>
                 <ul class="list-inline font-12 mb-5">
                   <li class="pr-0"><i class="fa fa-calendar mr-5"></i> {{ date('d/m/Y', strtotime($value->startDate)) }} |</li>
                   <li class="pl-5"><i class="fa fa-map-marker mr-5"></i>Institute</li>
                 </ul>
                 <p class="mb-0 font-13">{{$value->description}}</p>
              
                 
               </div>
             </article>
            
     @endforeach


           </div>
           <div class="col-md-6">
          <h2 class="text-uppercase line-bottom mt-0 line-height-1">Why <span class="text-theme-color-2">Choose Us</span></h2>
          
          <div id="accordion1" class="panel-group accordion">
            <div class="panel">
              <div class="panel-title"> <a class="active" data-parent="#accordion1" data-toggle="collapse" href="#accordion11" aria-expanded="true"> <span class="open-sub"></span> Online Mock Tests</a> </div>
              <div id="accordion11" class="panel-collapse collapse in" role="tablist" aria-expanded="true">
                <div class="panel-content">
                  <p>Based on latest exam patterns we offer our students the facility of Online Mock Tests. Our Mock Tests are based on extensive research and it gets updated with the dynamic changes in the exam patterns.</p>
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion12" class="" aria-expanded="true"> <span class="open-sub"></span>Economical Fees</a> </div>
              <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                <div class="panel-content">
                  <p>In this competitive world, we care for our student’s welfare and we care for their pockets and charge nominal fees which is best in market and still offer quality education to them.</p>
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion13" class="" aria-expanded="true"> <span class="open-sub"></span>Personal Attention</a> </div>
              <div id="accordion13" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                <div class="panel-content">
                  <p>We treat our students as family and our batch strength is minimal so it is easy for our students and faculties to have one to one conversation and clear the doubts as soon as it arises.</p>
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion14" class="" aria-expanded="true"> <span class="open-sub"></span>Doubt Solving Sessions</a> </div>
              <div id="accordion14" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                <div class="panel-content">
                  <p>We provide lifetime assistance to our students and never leave them in doubt. Before getting into any new topic we always make sure that no doubt should be left related to any covered topics.</p>
                </div>
              </div>
            </div>
            <div class="panel">
              <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion15" class="" aria-expanded="true"> <span class="open-sub"></span> Experienced Faculties</a> </div>
              <div id="accordion15" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                <div class="panel-content">
                  <p>Our way of teaching is innovative and leaves an everlasting impact on students as we make them understand the shortest possible tips and tricks and hand in hand clear their basic concepts.</p>
                </div>
              </div>
            </div>

            <div class="panel">
              <div class="panel-title"> <a data-parent="#accordion1" data-toggle="collapse" href="#accordion16" class="" aria-expanded="true"> <span class="open-sub"></span> Distinctive Study Material </a> </div>
              <div id="accordion16" class="panel-collapse collapse" role="tablist" aria-expanded="true">
                <div class="panel-content">
                  <p>Based on extensive research, we offer study material to every student. Our books is a mixture of experience, knowledge and the patterns followed in the exam and compiled by our experienced faculties.</p>
                </div>
              </div>
            </div>

          </div>
        </div>
         </div>
       </div>
     </div>
   </section>

    
   <section class="divider parallax layer-overlay overlay-theme-colored-9" data-background-ratio="0.5" data-bg-img="{{URL::to('assets/web/images/bg/bg2.jpg')}}">
     <div class="container pb-50">
       <div class="section-title">
         <div class="row">
           <div class="col-md-6">
             <h2 class="font-weight-300 m-0 text-gray-lightgray">Happy Student</h2>
             <h2 class="mt-0 mb-0 text-uppercase line-bottom text-white font-28">Testimonials<span class="font-30 text-theme-color-2">.</span></h2>
           </div>
         </div>
       </div>
       <div class="row">
         <div class="col-md-12 mb-10">
           <div class="owl-carousel-2col boxed" data-dots="true">
              @foreach($testimonial as $value)
             <div class="item">
               <div class="testimonial pt-10">
                 <div class="thumb pull-left mb-0 mr-0 pr-20">
                   <img width="50" class="img-circle w-25" style="width:200px; height:200px;" alt="" src="{{URL::to('uploads/property/'.$value->image)}}">
                 </div>
                 
                 <div class="ml-100 ">
                   <h4 class="text-white mt-0">{{$value->message}}</h4>
                   <p class="author mt-20">- <span class="text-theme-color-2">{{$value->feedback_uid
                    }},</span> <small><em class="text-gray-lightgray">{{$value->rate}}</em></small></p>
                 </div>
               </div>
             </div>
             @endforeach
             
           </div> 
         </div>
       </div>
     </div>
   </section>

  
   <section id="blog" class="bg-lighter">
     <div class="container">
       <div class="section-title mb-10">
         <div class="row">
           <div class="col-md-8">
             <h2 class="mt-0 text-uppercase font-28 line-bottom line-height-1">Latest <span class="text-theme-color-2 font-weight-400">News</span></h2>
          </div>
         </div>
       </div>
       <div class="section-content">
         <div class="row">
          @foreach($news as $value)
           <div class="col-xs-12 col-sm-6 col-md-4 wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.3s">
             <article class="post clearfix mb-sm-30">
               <div class="entry-header">
                 <div class="post-thumb thumb"> 
                   <img src="{{URL::to('/uploads/category/'.$value->image)}}" alt="" class="img-responsive img-fullwidth"> 
                 </div>
               </div>
               <div class="entry-content p-20 pr-10 bg-white">
                 <div class="entry-meta media mt-0 no-bg no-border">
                   <div class="entry-date media-left text-center flip bg-theme-colored pt-5 pr-15 pb-5 pl-15">
                   
                   
                     <ul>
                       <li class="font-16 text-white font-weight-600 border-bottom">{{date("d", strtotime($value->created_at))}} </li>
                       <li class="font-12 text-white text-uppercase">{{date("M", strtotime($value->created_at))}}</li>
                     </ul>
                   </div>
                   <div class="media-body pl-15">
                     <div class="event-content pull-left flip">
                       <h4 class="entry-title text-white text-uppercase m-0 mt-5"><a href="{{URL::to('/blog-details/'.$value->slug)}}">{{$value->title}}</a></h4>
                                 
                     </div>
                   </div>
                 </div>
                 <p class="mt-10"> {!! \Illuminate\Support\Str::limit(html_entity_decode($value->content), 150) !!}</p>
                 <a href="{{URL::to('/blog-details/'.$value->slug)}}" class="btn-read-more">Read more</a>
                 <div class="clearfix"></div>
               </div>
             </article>
           </div>
           @endforeach
           
         </div>
       </div>
     </div>
   </section>

    
 </div>

 <script>

 


         $(document).ready(function(e) {
           $(".rev_slider").revolution({
             sliderType:"standard",
             sliderLayout: "auto",
             dottedOverlay: "none",
             delay: 5000,
             navigation: {
                 keyboardNavigation: "off",
                 keyboard_direction: "horizontal",
                 mouseScrollNavigation: "off",
                 onHoverStop: "off",
                 touch: {
                     touchenabled: "on",
                     swipe_threshold: 75,
                     swipe_min_touches: 1,
                     swipe_direction: "horizontal",
                     drag_block_vertical: false
                 },
               arrows: {
                 style:"zeus",
                 enable:true,
                 hide_onmobile:true,
                 hide_under:600,
                 hide_onleave:true,
                 hide_delay:200,
                 hide_delay_mobile:1200,
                 tmp:'<div class="tp-title-wrap">    <div class="tp-arr-imgholder"></div> </div>',
                 left: {
                   h_align:"left",
                   v_align:"center",
                   h_offset:30,
                   v_offset:0
                 },
                 right: {
                   h_align:"right",
                   v_align:"center",
                   h_offset:30,
                   v_offset:0
                 }
               },
               bullets: {
                 enable:true,
                 hide_onmobile:true,
                 hide_under:600,
                 style:"metis",
                 hide_onleave:true,
                 hide_delay:200,
                 hide_delay_mobile:1200,
                 direction:"horizontal",
                 h_align:"center",
                 v_align:"bottom",
                 h_offset:0,
                 v_offset:30,
                 space:5,
                 tmp:'<span class="tp-bullet-img-wrap">  <span class="tp-bullet-image"></span></span><span class="tp-bullet-title">title</span>'
               }
             },
             responsiveLevels: [1240, 1024, 778],
             visibilityLevels: [1240, 1024, 778],
             gridwidth: [1170, 1024, 778, 480],
             gridheight: [650, 768, 960, 720],
             lazyType: "none",
             parallax: {
                 origo: "slidercenter",
                 speed: 1000,
                 levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 100, 55],
                 type: "scroll"
             },
             shadow: 0,
             spinner: "off",
             stopLoop: "on",
             stopAfterLoops: 0,
             stopAtSlide: -1,
             shuffle: "off",
             autoHeight: "off",
             fullScreenAutoWidth: "off",
             fullScreenAlignForce: "off",
             fullScreenOffsetContainer: "",
             fullScreenOffset: "0",
             hideThumbsOnMobile: "off",
             hideSliderAtLimit: 0,
             hideCaptionAtLimit: 0,
             hideAllCaptionAtLilmit: 0,
             debugMode: false,
             fallbacks: {
                 simplifyAll: "off",
                 nextSlideOnWindowFocus: "off",
                 disableFocusListener: false,
             }
           });
         });
       </script>
      <section class="bg-theme-color-2" style='background-color:#f47621 !important'>
  <div class="container pt-10 pb-20">
    <div class="row">
      <div class="call-to-action">
        <div></div>
        <div class="d-flex content-space-between" style='display:flex; justify-content:space-around'  >
        <h2 style="font-weight:800;"> DOWNLOAD OUR APP </h2>  
        <a style="width:20%;" href="https://play.google.com/store/apps/details?id=com.sterlingeducation.edu" target="_blank"><img src="{{URL::to('assets/images/app.png')}}"    /></a>

           
          
        </div>
       

      </div>
    </div>
  </div>
</section>
@include('layouts.webfooter')
</div>
</body>

</html>
