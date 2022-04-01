var cacheName = "v1";

var cacheFiles = [
  "/",
  "/index.php",
  "/public/assets/",
  "/public/scripts/",
  "/public/styles/",
  "https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined",
  "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js",
  "https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;400;500;600&family=Nunito:wght@200;300;400;500;600&display=swap",
];

self.addEventListener("install", function (e) {
  console.log("[ServiceWorker] Installed");

  // e.waitUntil Delays the event until the Promise is resolved
  e.waitUntil(
    // Open the cache
    caches.open(cacheName).then(function (cache) {
      // Add all the default files to the cache
      console.log("[ServiceWorker] Caching cacheFiles");
      return cache.addAll(cacheFiles);
    })
  ); // end e.waitUntil
});

self.addEventListener("activate", function (e) {
  console.log("[ServiceWorker] Activated");

  e.waitUntil(
    // Get all the cache keys (cacheName)
    caches.keys().then(function (cacheNames) {
      return Promise.all(
        cacheNames.map(function (thisCacheName) {
          // If a cached item is saved under a previous cacheName
          if (thisCacheName !== cacheName) {
            // Delete that cached file
            console.log(
              "[ServiceWorker] Removing Cached Files from Cache - ",
              thisCacheName
            );
            return caches.delete(thisCacheName);
          }
        })
      );
    })
  ); // end e.waitUntil
});

self.addEventListener("fetch", function (event) {
  event.respondWith(
    caches.open("Nom_du_cache").then(function (cache) {
      return cache.match(event.request).then(function (response) {
        return (
          response ||
          fetch(event.request).then(function (response) {
            cache.put(event.request, response.clone());
            return response;
          })
        );
      });
    })
  );
});
