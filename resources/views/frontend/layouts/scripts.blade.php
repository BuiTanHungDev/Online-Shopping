
<!-- jQuery (Necessary for All JavaScript Plugins) -->
<script src="{{asset('frontend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.easing.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/classy-nav.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/scrollup.js')}}"></script>
<script src="{{asset('frontend/assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jarallax.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jarallax-video.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/active.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>
{{-- autosearch --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
{{-- libary sweetaler --}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

{{-- bootstrap notify --}}
<script src="{{asset('frontend/assets/js/bootstrap-notify.js')}}"></script>


<script>
  @if (\Illuminate\Support\Facades\Session::has('success'))
      $.notify("Success: {{ \Illuminate\Support\Facades\Session::get('success') }}", {
          animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
          }
      });
      @php
          \Illuminate\Support\Facades\Session::forget('success');
      @endphp
  @endif
</script>
<script>
  @if (\Illuminate\Support\Facades\Session::has('error'))
      $.notify("Sorry: {{ \Illuminate\Support\Facades\Session::get('error') }}", {
          animate: {
              enter: 'animated fadeInRight',
              exit: 'animated fadeOutRight'
          }
      });
      @php
          \Illuminate\Support\Facades\Session::forget('error');
      @endphp
  @endif
</script>


<script>
    setTimeout(function() 
    {
      $('#alert').slideup();
    },4000);
</script>


@yield('scripts')