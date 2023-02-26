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
          <h2 class="title text-black text-center">TEACHER DETAILS</h2>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Section: Experts Details -->
    <section>
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-4">
              <div class="thumb">
                <img src="{{URL::to('uploads/property/'.$teacher->image)}}" alt="">
              </div>
            </div>
            <div class="col-md-8">
              <h4 class="name font-24 mt-0 mb-0">{{$teacher->teacher_name}}</h4>
              <h5 class="mt-5 text-theme-color-2">{{$teacher->subtitle}}</h5>
              <p>{{$teacher->description}}</p>
               
            </div>
          </div>
          <div class="row mt-30">
            <div class="col-md-4">
              <h4 class="line-bottom">About Me:</h4>
              <div class="volunteer-address">
                <ul>
                  <li>
                    <div class="bg-light media border-bottom p-15 mb-20">
                      <div class="media-left">
                        <i class="pe-7s-pen text-theme-colored font-24 mt-5"></i>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-0">Experiences:</h5>
                        <p>{{$teacher->experiences}}</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="bg-light media border-bottom p-15 mb-20">
                      <div class="media-left">
                        <i class="fa fa-map-marker text-theme-colored font-24 mt-5"></i>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-0">Address:</h5>
                        <p>1/1227 Malviya Nagar, Jaipur - 302017, Rajasthan</p>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="bg-light media border-bottom p-15">
                      <div class="media-left">
                        <i class="fa fa-phone text-theme-colored font-24 mt-5"></i>
                      </div>
                      <div class="media-body">
                        <h5 class="mt-0 mb-0">Contact:</h5>
                        <p><span>Phone:</span> {{$teacher->mobile}}<br><span>Email:</span> {{$teacher->email}}</p>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <h4 class="line-bottom">Find Location:</h4>

              <!-- Google Map HTML Codes --><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.706362436611!2d75.82308499999999!3d26.8492903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db6139f0a8bb9%3A0xcf28f3d2c60a7300!2sSterling%20Education%20%7C%20Bank%2C%20SSC%2C%20Insurance%2C%20CDS%2C%20AFCAT%20%26%20Other%20Competitive%20Exams%20Coaching%20in%20Jaipur!5e0!3m2!1sen!2sin!4v1668831571500!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
            <div class="col-md-4">
              <div class="clearfix">
                <h4 class="line-bottom">Quick Contact:</h4>
              </div>
              <form id="contact_form" name="contact_form" class="form-transparent" action="{{ route('sendEnquiry') }}" method="post">
              @csrf
                
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group mb-10">
                      <input name="form_name" class="form-control" type="text" required="" placeholder="Enter Name" aria-required="true">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-10">
                      <input name="form_email" class="form-control required email" type="email" placeholder="Enter Email" aria-required="true">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group mb-10">
                      <input name="form_phone" class="form-control required" type="text" placeholder="Enter Phone" aria-required="true">
                    </div>
                  </div>
                
               
                   
                </div>
                <div class="form-group mb-10">
                  <textarea name="form_message" class="form-control required" placeholder="Enter Message" rows="3" aria-required="true"></textarea>
                </div>
                <div class="form-group mb-0 mt-20">
                  <input name="form_botcheck" class="form-control" type="hidden" value="">
                  <button type="submit" class="btn btn-colored btn-theme-color-2 text-white btn-lg btn-block" data-loading-text="Please wait...">Submit Request</button>
                </div>
              </form>
              <script type="text/javascript">
                $("#contact_form").validate({
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
                  document.getElementById("contact_form").reset();
                  setTimeout(function(){ $(form_result_div).fadeOut('slow') }, 6000);
                }
              });
            }
          });
              </script>
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
