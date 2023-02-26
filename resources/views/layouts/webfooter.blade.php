<style>
  #floating-share-buttons {
  list-style-type: none;
  margin: 0;
  padding: 0;
  font-size: 0;
}
#floating-share-buttons li {
  
}
#floating-share-buttons a {
  color: #fff;
  text-decoration:none;
  font-size:14px;
}
#floating-share-buttons a.share-facebook {
  background-color: #395793 ;
}
#floating-share-buttons a.share-pinterest {
  background-color: #b8171c ;
}
#floating-share-buttons a.share-twitter {
  background-color: #1c9deb ;
}
#floating-share-buttons a.share-linkedin {
  background-color: #21577e ;
}
#floating-share-buttons a.share-whatsapp {
  background-color: #48a91f ;
}
#floating-share-buttons a.share-mail {
  background-color: #333 ;
}
/*
  Breakpoint is 1024px. You change this value to adapt it to your design
*/

/* Desktop */ @media (min-width: 1023px) {
  ul#floating-share-buttons {    
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    min-height: 100px;
    padding: 0px;
  }
  ul#floating-share-buttons a {
    width:2rem;
    height:2.5rem;
    align-items: center;
    display: inline-flex;
    justify-content: center;    
    transition: width 0.5s;
  }
  ul#floating-share-buttons a:hover {
    width:2.5rem;
  }
  #floating-share-buttons a.share-whatsapp {
    display:none;
  }
}
  @media (max-width: 1024px) { 
 
  #floating-share-buttons {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;        
    text-align: center;    
  }
  #floating-share-buttons li {
    display:inline-block;
    width:calc(100% / 6);
    padding:0;
    margin:0;
  }
  #floating-share-buttons li a {
    align-items: center;
    display: inline-flex;
    justify-content: center;
    height:3rem;
    width:100%;    
  }
}
</style>

<footer id="footer" class="footer divider layer-overlay overlay-dark-9" data-bg-img="images/bg/bg2.jpg">
    <div class="container pb-0">
      <div class="row border-bottom">
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <img class="mt-5 mb-20" alt="" src="images/logo-white-footer.png">
            <p class="widget-title">Sterling Education | Bank, SSC, Insurance, CDS, AFCAT & Other Competitive Exams Coaching in Jaipur</p>
            <ul class="list-inline mt-5">
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-map-marker text-theme-color-2 mr-5"   style="color:#f47621"></i> <a class="text-gray" href="#">1/1227 Malviya Nagar, Jaipur - 302017, Rajasthan</a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-phone text-theme-color-2 mr-5"style="color:#f47621"></i> <a class="text-gray" href="#">+91 9680410911</a> </li>
              <li class="m-0 pl-10 pr-10"> <i class="fa fa-envelope-o text-theme-color-2 mr-5"style="color:#f47621"></i> <a class="text-gray" href="#">info@sterlingeducation.co.in</a> </li>
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h4 class="widget-title">Quick Links</h4>
            <ul class="list angle-double-right list-border">
              <li><a href="{{ route('about') }}">About Us</a></li>
              <li><a href="https://play.google.com/store/apps/details?id=com.sterlingeducation.edu">Online Mock Test</a></li>
              <li><a href="{{ route('downloadlist') }}">Downloads</a></li>
              <li><a href="{{ route('gallery') }}">Gallery</a></li>
              <li><a href="{{ route('blogInfinity') }}">Latest News</a></li>              
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="widget dark">
            <h4 class="widget-title">Useful Links</h4>
            <ul class="list angle-double-right list-border">
              <li><a href="{{ route('shop') }}">Books</a></li>
              <li><a href="{{ route('mocktest') }}">Mock Tests</a></li>
              <li><a href="{{ route('joblist') }}">Careers</a></li>
              <li><a href="{{ route('event') }}">Upcoming Batches</a></li>
              <li><a href="{{ route('contact') }}">Contact Us</a></li>              
            </ul>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
        <div class="widget dark">
            <h5 class="widget-title mb-10">Connect With Us</h5>
            <ul class="styled-icons icon-bordered icon-sm">
              
            <li><a class='fb' target="_blank" href="https://www.facebook.com/sterlingeduc"><i class="fa fa-facebook text-white"></i></a></li>
                <li><a class='youtube' target="_blank" href="https://www.youtube.com/channel/UCvTokxJYDpRNDAKsFOyzVyA?view_as=subscriber"><i class="fa fa-youtube text-white"></i></a></li>
                <li><a class='gplus' target="_blank" href="https://www.google.com/maps/place//data=!4m3!3m2!1s0x396db6139f0a8bb9:0xcf28f3d2c60a7300!12e1?source=g.page.default"><i class="fa fa-google-plus text-white"></i></a></li>
                <li><a target="_blank" class='insta' href="https://www.instagram.com/education.sterling/"><i class="fa fa-instagram text-white"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
       
    </div>
    <div class="footer-bottom bg-black-333">
      <div class="container pt-20 pb-20">
        <div class="row">
          <div class="col-md-6">
            <p class="font-11 text-black-777 m-0">Copyright ©2022 Sterling Education. All Rights Reserved.</p>
          </div>
          <div class="col-md-6 text-right">
            <div class="widget no-border m-0">
              <ul class="list-inline sm-text-center mt-5 font-12">
                <li>
                  <a href="{{ route('faq') }}"><b>FAQ</b></a>
                </li>
                <li>|</li>
                <li>
                  <a href="{{ route('about') }}"><b>Help Desk</b></a>
                </li>
                <li>|</li>
                <li>
                <a href="{{ route('contact') }}"><b>Support</b></a>
                  
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <ul id="floating-share-buttons">
    <li><a href="https://www.facebook.com/sterlingeduc" target="_blank" class="share-facebook"><i class="fa fa-facebook fa-1x" aria-hidden="true"></i></a></li>
    
    <li><a href="https://www.instagram.com/education.sterling/" class="share-twitter" target="_blank"><i class="fa fa-instagram fa-1x" aria-hidden="true"></i></a></li>
    <li><a href="https://www.youtube.com/channel/UCvTokxJYDpRNDAKsFOyzVyA?view_as=subscriber" class="share-linkedin" target="_blank"><i class="fa fa-youtube fa-1x" aria-hidden="true"></i></a></li>
    <li><a href="https://www.google.com/maps/place//data=!4m3!3m2!1s0x396db6139f0a8bb9:0xcf28f3d2c60a7300!12e1?source=g.page.default" class="share-linkedin" target="_blank"><i class="fa fa-google fa-1x" aria-hidden="true"></i></a></li>
    
    <li><a  href="https://wa.me/918829935990" target="_blank" class="share-mail" ><i class="fa fa-whatsapp fa-1x" aria-hidden="true"></i></a></li>
  </ul>
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>

  <script type="text/javascript" src="{{URL::to('assets/web/js/custom.js')}}"></script>
  



 