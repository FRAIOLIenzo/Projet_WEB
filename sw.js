if ("serviceWorker" in navigator) {
    window.addEventListener("load", function () {
      navigator.serviceWorker.register("/sw.js").then(
        function (registration) {
          console.log(
            "ServiceWorker fonctionnel : ",
            registration.scope
          );
        },
        function (err) {
          console.log("ServiceWorker échoue: ", err);
        }
      );
    });
  }
  