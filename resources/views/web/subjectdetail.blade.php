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
<title>{{$courselist->meta_title}}</title>
<link rel="icon" type="image/x-icon" href="{{URL::to('favicon.png')}}">
<meta name="description" content="{{$courselist->meta_description}}">
<meta name="keyword" content="{{$courselist->meta_keyword}}">
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
        <div class="col-md-12 text-center">
          <h2 class="title text-black">{{$courselist->title}}</h2>
        </div>
      </div>
    </div>
  </div>
</section>

    <!-- Section: Blog -->
    <section>
      <div class="container">




        <div class="row">
          
          <div class="col-md-8 blog-pull-left">
            <div class="single-service">
              
              <img src="{{URL::to('uploads/property/'.$courselist->image)}}" alt="">
              <h3 class="text-theme-colored line-bottom text-theme-colored">{{$courselist->title}}</h3>
              <h4 class="mt-0"><span class="text-theme-color-2">Price :</span>₹{{$courselist->price}}/-</h4>
                
              <p>
              {!! $courselist->description !!}
              </p>
              <h4 class="line-bottom mt-20 mb-20 text-theme-colored">All Courses Idea</h4>
              <ul id="myTab" class="nav nav-tabs boot-tabs">
                <li class="active"><a href="#small" data-toggle="tab">Syllabus</a></li>
                <li><a href="#medium" data-toggle="tab">Exam Pattern</a></li>
                <li><a href="#large" data-toggle="tab">Eligibility Criteria</a></li>
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade in active" id="small">
                 {!! $courselist->Syllabus !!}
                </div>
                <div class="tab-pane fade" id="medium">
                {!! $courselist->pattern !!}
                </div>
                <div class="tab-pane fade" id="large">
                {!! $courselist->criteria !!}
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12 col-md-4">
            <div class="sidebar sidebar-right mt-sm-30 ml-40">
              <div class="widget">
                <h4 class="widget-title line-bottom">Courses <span class="text-theme-color-2">List</span></h4>
                <div class="services-list">
                  <ul class="list list-border angle-double-right">
                  @foreach($subjectDetail as $key=>$value)

                  <li class="{{$courselist->slug ==$value->slug ? 'active' : ''}}"><a href="{{URL::to('coursedetail/'.$value->slug)}}">{!! $value->title !!}</a>
                  </li>
                    @endforeach

                  </ul>
                </div>
              </div>
               
              <div class="widget">
                <h4 class="widget-title line-bottom">Quick <span class="text-theme-color-2">Contact</span></h4>
                <form id="quick_contact_form_sidebar" name="footer_quick_contact_form" class="quick-contact-form" action="https://kodesolution.com/html/2016/studypress-html/demo/includes/quickcontact.php" method="post">
                  <div class="form-group">
                    <input name="form_emailphone" class="form-control" type="number" required="" placeholder="Enter Phone Number">
                  </div>
                  <div class="form-group">
                    <textarea name="form_message" class="form-control" required="" placeholder="Enter Message" rows="3"></textarea>
                  </div>
                  <div class="form-group">
                    <input name="form_botcheck" class="form-control" type="hidden" value="" />
                    <button type="submit" class="btn btn-theme-colored btn-flat btn-xs btn-quick-contact text-white pt-5 pb-5" data-loading-text="Please wait...">Send Message</button>
                  </div>
                </form>

                <!-- Quick Contact Form Validation-->
                <script type="text/javascript">
                  $("#quick_contact_form_sidebar").validate({
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
         
        </div>


   

      </div>
    </section>
  </div>

  
    @include('layouts.webfooter')
</div>
</body>

</html>
