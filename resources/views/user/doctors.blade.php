<div id="doctors-section" class="page-section">
    <div class="container">
      <h1 class="text-center mb-5 wow fadeInUp">{{__('strings.our doctors')}}</h1>

      <div class="owl-carousel wow fadeInUp" id="doctorSlideshow">
        @foreach ($doctors as $doctor)
          <div class="item">
            <div class="card-doctor">
              <div class="header">
                <img src="{{$doctor->image}}" alt="">
                <div class="meta">
                  <a href="#"><span class="mai-call"></span></a>
                  <a href="#"><span class="mai-logo-whatsapp"></span></a>
                </div>
              </div>
              <div class="body">
                <p class="text-xl mb-0">Dr. {{$doctor->name}}</p>
                <span class="text-sm text-grey">{{$doctor->speciality}}</span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function(){
      // عند النقر على الرابط "Doctors"
      $('a[href="#doctors-section"]').on('click', function(event) {
          // إيقاف سلوك الرابط الافتراضي
          event.preventDefault();

          // التمرير إلى الجزء المخصص لعرض الأطباء
          $('html, body').animate({
              scrollTop: $("#doctors-section").offset().top
          }, 1000);
      });
    });
  </script>
