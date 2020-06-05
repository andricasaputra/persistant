<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('plugins/bootstrap/js/tether.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<!--stickey kit -->
<script src="{{ asset('plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('js/custom.min.js') }}"></script>
<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!-- Flot Charts JavaScript -->
<script src="{{ asset('plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('plugins/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('js/flot-data.js') }}"></script>
<!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->
<script src="{{ asset('plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>

<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

{{-- <script>
if ('serviceWorker' in navigator && 'PushManager' in window) {

    window.addEventListener('load', function() {

        navigator.serviceWorker.register('{{ asset('sw.js') }}').then(function(registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
        }, function(err) {
            // registration failed :(
            console.log('ServiceWorker registration failed: ', err);
        });

        navigator.serviceWorker.addEventListener('message', function(event) {
            // console.log(event.data.message); // Hello World !
        });
        
    });

}
</script> --}}

{{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script>

<script>
  //instantiate a Pusher object with our Credential's key
  var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
      cluster: 'ap1'
  });

  //Subscribe to the channel we specified in our Laravel Event
  var channel = pusher.subscribe('users');

  //Bind a function to a Event (the full Laravel class)
  channel.bind('user-register', addMessage);

  function addMessage(data) {
        var listItem = $("<li class='list-group-item'></li>");
        listItem.html(data.message);
        $('.dropdown-count').html(data.length + 1); 
        $('#main_notifications').prepend(listItem);
  }
</script> --}}