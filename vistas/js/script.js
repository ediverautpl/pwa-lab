;
//Registro de Características de PWA's
((d, w, n, c) => {
  //Registro de SW
    if ('serviceWorker' in n) {
        w.addEventListener('load', () => {
            n.serviceWorker.register('./sw.js')
            .then( registration => {
                c(registration)
                c('Service Worker registrado con éxito', 
                registration.scope)
            })
            .catch( err => c('Registro de Service Worker fallido', 
            err))
        })
    }

})(document, window, navigator, console.log);


//Detección del Estado de la Conexión
((d, w, n, c) => {
    const header = d.querySelector('.Header'),
      metaTagTheme = d.querySelector('meta[name=theme-color]')
  
    function networkStatus (e) {
      c( e, e.type )
  
      if ( n.onLine ) {
        metaTagTheme.setAttribute('content', '#47bac1')
        header.classList.remove('u-offline')
        swal({
          type: "success",
          title: "Conexión Recuperada",
          showConfirmButton:false,
          timer: 2000
        })
      } else {
        metaTagTheme.setAttribute('content', '#666')
        header.classList.add('u-offline')
        swal({
          type: "error",
          title: "Conexión Perdida",
          showConfirmButton:false,
          timer: 2000
        })
      }
    }
  
    d.addEventListener('DOMContentLoaded', e => {
      if ( !n.onLine ) {
        networkStatus(this)
      }
  
      w.addEventListener('online', networkStatus)
      w.addEventListener('offline', networkStatus)
      
    })
  })(document, window, navigator, console.log);

  