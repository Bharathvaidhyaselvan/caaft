/**
 * Load reCAPTCHA only when a widget is near the viewport.
 */
(function () {
  "use strict";

  var loaded = false;

  function loadRecaptcha() {
    if (loaded || document.querySelector('script[src*="recaptcha/api.js"]')) {
      loaded = true;
      return;
    }

    loaded = true;
    var script = document.createElement("script");
    script.src = "https://www.google.com/recaptcha/api.js";
    script.async = true;
    script.defer = true;
    document.head.appendChild(script);
  }

  function init() {
    var widgets = document.querySelectorAll(".g-recaptcha");
    if (!widgets.length) {
      return;
    }

    if (!("IntersectionObserver" in window)) {
      loadRecaptcha();
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            loadRecaptcha();
            observer.disconnect();
          }
        });
      },
      { rootMargin: "200px 0px" },
    );

    widgets.forEach(function (widget) {
      observer.observe(widget);
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", init);
  } else {
    init();
  }
})();
