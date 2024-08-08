@extends('layouts.frontend')
@section('title','U-Clean Laundry Depok | Wet Clean with Personal Care')
@section('header')
@include('frontend.header')
@endsection
@section('banner')
{{-- banner --}}
@include('frontend.banner')
{{-- End banner --}}
@endsection

@section('content')
@include('frontend.content')
@endsection

@section('footer')
@include('frontend.footer')


{{-- Add to Home Screen Button --}}
<div class="a2hsbutton">
  <a class="a2hs">
    <img src="{{ asset('frontend/img/a2h.png') }}" alt="Add to Home Screen">
  </a>
</div>
{{-- End: Add to Home Screen Button --}}


{{-- Whatsapp Button Start--}}
<a href="https://wa.me/{{$setpage->whatsapp ?? ''}}" target="blank_">
  <img src="{{asset('frontend/img/wa.png')}}" class="wabutton" alt="WhatsApp-Button">
</a>
{{-- End: Whatsapp Button --}}
@endsection

@section('scripts')
<script type="text/javascript">
  $(document).on('click', '.search-btn', function(e) {
    _curr_val = $('#search_status').val();
    $('#search_status').val(_curr_val + $(this).html());
  });

  $(document).on('click', '#search-btn', function(e) {
    var search_status = $("#search_status").val();
    $.get('pencarian-laundry', {
      '_token': $('meta[name=csrf-token]').attr('content'),
      search_status: search_status
    }, function(resp) {
      if (resp != 0) {
        $(".modal_status").show();
        $("#customer").html(resp.customer);
        $("#tgl_transaksi").html(resp.tgl_transaksi);
        $("#status_order").html(resp.status_order);
      } else {
        swal({
          html: "No Invoice Tidak Terdaftar!"
        })
      }
    });
  });

  function close_dlgs() {
    $(".modal_status").hide();
    $("#search_status").val("");
  }

  if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
      navigator.serviceWorker.register('/sw.js').then(function(registration) {
        // Registration was successful
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
      }, function(err) {
        // registration failed :(
        console.log('ServiceWorker registration failed: ', err);
      });
    });
  }

  let deferredPrompt;
  var div = document.querySelector('.a2hsbutton');
  var button = document.querySelector('.a2hs');
  div.style.display = 'none';
  console.log(button);

  window.addEventListener('beforeinstallprompt', (e) => {
    console.log('beforeinstallprompt fired');
    // Prevent Chrome 67 and earlier from automatically showing the prompt
    e.preventDefault();
    // Stash the event so it can be triggered later.
    deferredPrompt = e;
    div.style.display = 'block';

    button.addEventListener('click', (e) => {
      // hide our user interface that shows our A2HS button
      div.style.display = 'none';
      // Show the prompt
      deferredPrompt.prompt();
      // Wait for the user to respond to the prompt
      deferredPrompt.userChoice
        .then((choiceResult) => {
          if (choiceResult.outcome === 'accepted') {
            console.log('User accepted the A2HS prompt');
          } else {
            console.log('User dismissed the A2HS prompt');
          }
          deferredPrompt = null;
        });
    });
  });
</script>
@endsection