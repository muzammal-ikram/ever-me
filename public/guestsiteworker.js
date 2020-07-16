
var CACHE_NAME = 'guest-site-assets';

/**
 * The install event is fired when the registration succeeds.
 * After the install step, the browser tries to activate the service worker.
 * Generally, we cache static resources that allow the website to run offline
 */

self.addEventListener('install', function(e) {
    console.log('install');
    e.waitUntil(
        caches.open(CACHE_NAME).then(function(cache) {
            return cache.addAll([
                '/',
                'guest_site/css/bootstrap.min.css',
                'guest_site/css/all.min.css',
                'guest_site/css/select2.min.css',
                'https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.27.0/feather.min.js',
                'guest_site/css/styles.css',
                'guest_site/js/jquery.min.js',
                'guest_site/js/bootstrap.min.js',
                'guest_site/js/all.min.js',
                'guest_site/js/select2.min.js',
                'guest_site/js/scripts.js'
            ]);
        })
    );
    console.log(caches);
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        fetch(event.request).catch(function() {
            return caches.match(event.request);
        })
    );
});
