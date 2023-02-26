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
    
    @include('layouts.webnavigtion')

    <div class="main-content">

<!-- Section: inner-header -->
<section class="inner-header divider parallax   bg-orange">
  <div class="container pt-20 pb-20">
    <!-- Section Content -->
    <div class="section-content">
      <div class="row">
        <div class="col-md-12">
          <h2 class="title text-black centertext">CONTACT US</h2>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Divider: Contact -->
<section class="divider layer-overlay overlay-white-9" data-bg-img="images/bg/bg15.html">
  <div class="container">
    <div class="row pt-30">
      <div class="col-md-8">
        <h3 class="line-bottom mt-0 mb-20">Write us</h3>
        <!-- Contact Form -->
        <form id="contact_form" name="contact_form" class="form-transparent" action="{{ route('sendEnquiry') }}" method="post">
        @csrf
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="form_name">Name <small>*</small></label>
                <input name="form_name" class="form-control" type="text" placeholder="Enter Name" required="">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="form_email">Email <small></small></label>
                <input name="form_email" class="form-control  email" type="email" placeholder="Enter Email">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="form_name">Subject <small>*</small></label>
                <input name="form_subject" class="form-control required" type="text" placeholder="Enter Subject">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="form_phone">Phone</label>
                <input name="form_phone" class="form-control" type="text" placeholder="Enter Phone" required="">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="form_name">Message</label>
            <textarea name="form_message" class="form-control required" rows="5" placeholder="Enter Message"></textarea>
          </div>
          <div class="form-group">
            <input name="form_botcheck" class="form-control" type="hidden" value="" />
            <button type="submit" class="btn btn-dark btn-theme-colored btn-flat mr-5" data-loading-text="Please wait...">Send your message</button>
            <button type="reset" class="btn btn-default btn-flat btn-theme-colored">Reset</button>
          </div>
        </form>
        <!-- Contact Form Validation-->
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
      <div class="col-md-4">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-map-2 maplocation text-theme-color-2"></i></a>
              <div class="media-body"> <strong class="text-white">OUR OFFICE LOCATION</strong> <br/>
                <a href="https://maps.app.goo.gl/JmVxtLNYrruUWSM66"class="text-white"> 1/1227 Malviya Nagar, Jaipur - 302017, Rajasthan</a>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12 text-white">
            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="tel:+919680410911"> <i class="pe-7s-call text-theme-color-2"></i></a>
              <div class="media-body"> <strong class="text-white">OUR CONTACT NUMBER</strong>
                <p>+91 9680410911</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12 text-white">
            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="#"> <i class="pe-7s-mail emailIcon text-theme-color-2"></i></a>
              <div class="media-body"> <strong class="text-white">OUR CONTACT E-MAIL</strong>
                <p>info@sterlingeducation.co.in</p>
              </div>
            </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12 text-white">
            <div class="icon-box left media bg-black-333 p-25 mb-20"> <a class="media-left pull-left" href="https://wa.me/919680410911" target="_blank"> <i class="fa fa-whatsapp text-theme-color-2"></i></a>


              <div class="media-body"> <strong class="text-white">Connect on Whatsapp</strong>
                 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Divider: Google Map -->
<section>
  <div class="container-fluid p-0">
    <div class="row">

      <!-- Google Map HTML Codes -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.706362436611!2d75.82308499999999!3d26.8492903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396db6139f0a8bb9%3A0xcf28f3d2c60a7300!2sSterling%20Education%20%7C%20Bank%2C%20SSC%2C%20Insurance%2C%20CDS%2C%20AFCAT%20%26%20Other%20Competitive%20Exams%20Coaching%20in%20Jaipur!5e0!3m2!1sen!2sin!4v1668831571500!5m2!1sen!2sin" width="100%" height="450" style="border:0;" allowfullscreen="" ></iframe>


      
      <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5456.163483134849!2d144.95177475051227!3d-37.81589041361766!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4dd5a05d97%3A0x3e64f855a564844d!2s121+King+St%2C+Melbourne+VIC+3000%2C+Australia!5e0!3m2!1sen!2sbd!4v1556130803137!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe> -->

    </div>
  </div>
</section>
</div>
   

    
    
@include('layouts.webfooter')
</div>
</body>
</html>

