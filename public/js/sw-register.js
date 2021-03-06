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