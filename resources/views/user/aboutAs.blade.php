<div id="aboutas-section" class="page-section">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 py-3 wow fadeInUp">
        <h1>{{__('strings.welcome')}}</h1>
        <p class="text-grey mb-4">

          <h5>{{(__('strings.one'))}}</h5>
        </p>
        <p class="text-grey mb-4">

           <h5>{{(__('strings.two'))}}</h5>

        </p>
        <p class="text-grey mb-4">

            <h5>{{(__('strings.three'))}}</h5>

        </p>
        <p class="text-grey mb-4">

            <h5>{{(__('strings.four'))}}</h5>


        </p>
        <p class="text-grey mb-4">

            <h5>{{(__('strings.five'))}}</h5>


        </p>
        <p class="text-grey mb-4">

            <h5>{{(__('strings.six'))}}</h5>


        </p>
        <p class="text-grey mb-4">

            <h5>{{(__('strings.seven'))}}</h5>


        </p>
      </div>
      <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
        <div class="img-place custom-img-1">
          <img src="../assets/img/bg-doctor.png" alt="">
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function(){
      // عند النقر على الرابط "Doctors"
      $('a[href="#aboutas-section"]').on('click', function(event) {
          // إيقاف سلوك الرابط الافتراضي
          event.preventDefault();

          // التمرير إلى الجزء المخصص لعرض الأطباء
          $('html, body').animate({
              scrollTop: $("#aboutas-section").offset().top
          }, 1000);
      });
    });
  </script>
