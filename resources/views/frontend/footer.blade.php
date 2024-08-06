<div id="footer" class="footer">
    <!-- begin container -->
    <div class="container">
        <!-- begin row -->
        <div class="row">
            <!-- begin col-4 -->
            <div class="col-xl-4 col-lg-4 col-12">
                <!-- begin section-container -->
                <div class="section-container">
                    <h4>Visit Us At:</h4>
                    <p>
                      {{$setpage != NULL ? $setpage->tentang : 'Tentang belum diiisi'}}
                    </p>
                </div>
                <!-- end section-container -->
            </div>
            <div class="col-xl-4 col-lg-4 col-12">
                <!-- begin section-container -->
                <div class="section-container">
                <h4>Useful Links</h4>
                <ul>
                  <li><i class="ion-ios-arrow-right"></i> <a href="#home">Home</a></li>
                  <li><i class="ion-ios-arrow-right"></i> <a href="#background">Background</a></li>
                  <li><i class="ion-ios-arrow-right"></i> <a href="#vision">Vision</a></li>
                  <li><i class="ion-ios-arrow-right"></i> <a href="#services">Services</a></li>
                  <li><i class="ion-ios-arrow-right"></i> <a href="#methods">Methods</a></li>
                </ul>
                </div>
                <!-- end section-container -->
            </div>
            <div class="col-xl-4 col-lg-4 col-12" id="contact">
                <!-- begin section-container -->
                <div class="section-container">
                    <h4>Contact Us At:</h4>
                    <ul class="new-user">
                      <li>
                        <a href="https://facebook.com/{{$setpage->facebook ?? ''}}" target="_blank">
                          <i class="fa fa-facebook-square fa-2x" style="color: #4267B2"></i>
                        </a>
                      </li>
                      <li>
                        <a href="https://instagram.com/{{$setpage->instagram ?? ''}}" target="_blank">
                          <i class="fa fa-instagram fa-2x" style="color:#5B51D8"></i>
                        </a>
                      </li>
                      <li>
                        <a href="mailto:{{$setpage->email ?? ''}}" target="_blank">
                          <i class="fa fa-envelope fa-2x" style="color: #DB4437"></i>
                        </a>
                      </li>
                    </ul>
                </div>
                <!-- end section-container -->
            </div>
            <!-- end col-4 -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>