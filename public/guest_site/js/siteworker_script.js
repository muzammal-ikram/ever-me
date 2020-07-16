if('serviceWorker' in navigator) {
      navigator.serviceWorker
          .register('/guestsiteworker.js')
          .then(function() { console.log("Service Worker Registered");
          }).catch(function (error) {
          console.log('ServiceWorker registration failed:', error);
      });
  }
