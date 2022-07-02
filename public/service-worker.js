const cacheName = "wirespos-site-v1";
const filesToCache = ["/", "/login", "/menu", "/settings", "/history"];

self.addEventListener("install", (e) => {
    e.waitUntil(
        caches.open(cacheName).then((cache) => {
            cache.addAll(filesToCache);
        })
    );
});

self.addEventListener("fetch", (e) => {
    e.respondWith(
        (async () => {
            const resource = await caches.match(e.request);

            if (resource) {
                return resource;
            }

            const response = await fetch(e.request);
            return response;
        })()
    );
});

self.addEventListener("activate", (event) => {
    caches.keys().then((keyList) => {
        return Promise.all(
            keyList.map((key) => {
                console.log(key);
                if (key !== cacheName) {
                    return caches.delete(key);
                }
            })
        );
    });
    event.waitUntil(self.clients.claim());
});
