var staticCacheName = "e-personal-v" + new Date().getTime();
var filesToCache = [
    'offline.html',
    'css/animate.css',
    'css/bootstrap-theme.css',
    'css/bootstrap.css',
    'css/bootstrap.min.css',
    'css/jquery.dataTables.min.css',
    'css/spinners.css',
    'css/style.css',
    'css/colors/blue.css',
    'js/app.js',
    'js/bootstrap.js',
    'js/custom.js',
    'js/jquery.dataTables.min.js',
    'js/logtable.js',
    'plugins/bootstrap/css/bootstrap.min.css',
    'plugins/jquery/jquery.min.js',
    'plugins/bootstrap/js/tether.min.js',
    'plugins/bootstrap/js/bootstrap.min.js',
    'js/jquery.slimscroll.js',
    'js/waves.js',
    'js/sidebarmenu.js',
    'plugins/sticky-kit-master/dist/sticky-kit.min.js',
    'plugins/flot/jquery.flot.js',
    'js/flot-data.js',
    'plugins/styleswitcher/jQuery.style.switcher.js',
    'images/icons/icon-36.png',
    'images/icons/icon-48.png',
    'images/icons/icon-72.png',
    'images/icons/icon-96.png',
    'images/icons/icon-144.png',
    'images/icons/icon-192.png',
    'images/icons/icon-512.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("e-personal-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline.html');
            })
    )
});

self.addEventListener('push', function (event) {
  if (event && event.data) {
    self.pushData = event.data.text();
    // console.log(self.pushData)
    if (self.pushData) {
      event.waitUntil(self.registration.showNotification(self.pushData.title, {
        body: self.pushData,
        icon: self.pushData.data ? self.pushData.data.icon : null
      }).then(function() {
        clients.matchAll({type: 'window'}).then(function (clientList) {
          if (clientList.length > 0) {
            messageToClient(clientList[0], {
              message: self.pushData // suppose it is: "Hello World !"
            });
          }
        });
      }));
    }
  }
});