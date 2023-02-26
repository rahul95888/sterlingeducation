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
    <section class="inner-header divider parallax layer-overlay overlay-dark-5" data-bg-img="{{URL::to('assets/web/images/bg/bg3.jpg')}}">
      <div class="container pt-60 pb-60">
        <!-- Section Content -->
        <div class="section-content">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3 class="font-28 text-white">Event Details 1</h2>
              <ol class="breadcrumb text-center text-black mt-10">
                <li><a href="#">Home</a></li>
                <li><a href="#">Pages</a></li>
                <li class="active text-theme-colored">Page Title</li>
              </ol>
            </div>
          </div>
        </div>
      </div>      
    </section>

    <section class="bg-theme-colored">
      <div class="container pt-40 pb-40">
        <div class="row text-center">
          <div class="col-md-12">
            <h2 id="basic-coupon-clock" class="text-white"></h2>
            <!-- Final Countdown Timer Script -->
            <script type="text/javascript">
              $(document).ready(function() {
                $('#basic-coupon-clock').countdown('2020/10/10', function(event) {
                  $(this).html(event.strftime('%D days %H:%M:%S'));
                });
              });
            </script>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <ul>
              <li>
                <h5>Topics:</h5>
                <p>Web design & development, Graphics design</p>
              </li>
              <li>
                <h5>Host:</h5>
                <p>Kodesolution Lmd.</p>
              </li>
              <li>
                <h5>Location:</h5>
                <p>{{$eventDetail->location}}</p>
              </li>
              <li>
                <h5>Start Date:</h5>
                <p>{{$eventDetail->startDate}}</p>
              </li>
              
              <li>
                <h5>Website:</h5>
                <p>kodesolution.com</p>
              </li>
              <li>
                <h5>Share:</h5>
                <div class="styled-icons icon-sm icon-gray icon-circled">
                  <a href="#"><i class="fa fa-facebook"></i></a>
                  <a href="#"><i class="fa fa-twitter"></i></a>
                  <a href="#"><i class="fa fa-instagram"></i></a>
                  <a href="#"><i class="fa fa-google-plus"></i></a>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-md-8">
            <img src="https://placehold.it/755x480" alt="">
          </div>
        </div>
        <div class="row mt-60">
          <div class="col-md-6">
            <h4 class="mt-0">{{$eventDetail->title}}</h4>
            <p>{{$eventDetail->description}}</p>
          </div>
     
        </div>
        <div class="row mt-40">
          <div class="col-md-12">
            <h4 class="mb-20">Keynote Speakers</h4>
            <div class="owl-carousel-6col" data-nav="true">
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="{{URL::to('assets/web/images/team/1.html')}}" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Lawyer</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="{{URL::to('assets/web/images/team/2.html')}}" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Businessman</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="{{URL::to('assets/web/images/team/3.html')}}" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Student</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/team/4.html" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Lawyer</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/team/5.html" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Businessman</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/team/6.html" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Student</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/team/3.html" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Student</h6>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="attorney">
                  <div class="thumb"><img src="images/team/4.html" alt=""></div>
                  <div class="content text-center">
                    <h5 class="author mb-0"><a class="text-theme-colored" href="#">Alex Jacobson</a></h5>
                    <h6 class="title text-gray font-12 mt-0 mb-0">Lawyer</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section: Registration Form -->
    <section class="divider parallax layer-overlay overlay-white-8" data-bg-img="images/bg/bg1.jpg">
      <div class="container-fluid">
        <div class="section-title">
          <div class="row">
            <div class="col-md-6 col-md-offset-3 text-center">
              <h3 class="title text-theme-colored">Registration Form</h3>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-md-offset-3">
            <form id="booking-form" name="booking-form" action="https://kodesolution.com/html/2016/studypress-html/demo/includes/event-register.php" method="post" enctype="multipart/form-data">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Name" name="register_name" required="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Email" name="register_email" class="form-control" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" placeholder="Enter Phone" name="register_phone" class="form-control" required="">
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Ticket types</label>
                    <select name="ticket_type" class="form-control">
                      <option>One Person</option>
                      <option>Two Person</option>
                      <option>Family Pack</option>
                      <option>Premium</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Event types</label>
                    <select name="event_type" class="form-control">
                      <option>Event 1</option>
                      <option>Event 2</option>
                      <option>Event 3</option>
                      <option>All package</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group text-center">
                  	<input name="form_botcheck" class="form-control" type="hidden" value="" />
                    <button data-loading-text="Please wait..." class="btn btn-dark btn-theme-colored btn-sm btn-block mt-20 pt-10 pb-10" type="submit">Register now</button>
                  </div>
                </div>
              </div>
            </form>
            <!-- Job Form Validation-->
            <script type="text/javascript">
              $("#booking-form").validate({
                submitHandler: function(form) {
                  var form_btn = $(form).find('button[type="submit"]');
                  var form_result_div = '#form-result';
                  $(form_result_div).remove();
                  form_btn.before('<div id="form-result" class="alert alert-success" role="alert" style="display: none;"></div>');
                  var form_btn_old_msg = form_btn.html();
                  form_btn.html(form_btn.prop('disabled', true).data("loading-text"));
                  $(form).ajaxSubmit({
                    dataType:  'json',
                    success: function(data) {
                      if( data.status == 'true' ) {
                        $(form).find('.form-control').val('');
                      }
                      form_btn.prop('disabled', false).html(form_btn_old_msg);
                      $(form_result_div).html(data.message).fadeIn('slow');
                      setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                    }
                  });
                }
              });
            </script>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4 class="mb-20">Photo Gallery</h4>
            <div class="owl-carousel-5col" data-nav="true">
              <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
              <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
              <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
              <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
              <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
              <div class="item"><img src="https://placehold.it/285x215" alt=""></div>
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
