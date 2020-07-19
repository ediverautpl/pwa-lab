const CACHE_NAME = 'pwa-lab-cache-v1',
urlsToCache = [
    './',
    '/?utm=homescreen',
    '/index.php',
    '/index.php?utm=homescreen',
    './vistas/css/plugins/bootstrap.min.css',
    './vistas/css/plugins/bootstrap.min.css.map',
    './vistas/css/plugins/flexslider.css',
    './vistas/css/plugins/font-awesome.min.css',
    './vistas/css/plugins/skin.css',
    './vistas/css/plugins/sweetalert.css',
    './vistas/css/plantilla.css',
    './vistas/css/cabezote.css',
    './vistas/css/slide.css',
    './vistas/css/laboratorios.css',
    './vistas/css/infolaboratorios.css',
    './vistas/css/perfil.css',
    './vistas/js/plugins/jquery.min.js',
    './vistas/js/plugins/bootstrap.min.js',
    './vistas/js/plugins/jquery.easing.js',
    './vistas/js/plugins/jquery.scrollUp.js',
    './vistas/js/plugins/jquery.flexslider.js',
    './vistas/js/plugins/sweetalert.min.js',
    './vistas/js/cabezote.js',
    './vistas/js/plantilla.js',
    './vistas/js/slide.js',
    './vistas/js/buscador.js',
    './vistas/js/infolaboratorios.js',
    './vistas/js/usuarios.js',
    './vistas/js/registroFacebook.js',
    './vistas/js/script.js'
    
  ]

  self.addEventListener('install', e => {
    console.log('Evento: SW Instalado')
    e.waitUntil(
      caches.open(CACHE_NAME)
        .then(cache => {
          console.log('Archivos en cache')
          return cache.addAll(urlsToCache)
          .then( () => self.skipWaiting() )
          //skipWaiting forza al SW a activarse
        })
        .catch(err => console.log('Falló registro de cache', err) )
    )
  })

  self.addEventListener('activate', e => {
    console.log('Evento: SW Activado')
    const cacheWhitelist = [CACHE_NAME]

    e.waitUntil(
        caches.keys()
        .then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    //Eliminamos lo que ya no se necesita en cache
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        return caches.delete(cacheName)
                    }
                })
            )
        })
        .then( () => {
            console.log('Cache actualizado')
            // Le indica al SW activar el cache actual
            return self.clients.claim()
        })
    )
})

self.addEventListener('fetch', e => {
    console.log('Evento: SW Recuperado')

    e.respondWith(
        caches.match(e.request)
        .then(res => {
            console.log('Recuperando cache')
            if (res) {
            //Si coincide lo retornamos del cache
                return res
            }
            //Sino, lo solicitamos a la red
            return fetch(e.request)
        })
    )

})