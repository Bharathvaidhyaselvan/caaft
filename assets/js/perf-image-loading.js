(function () {
  "use strict";

  function isEagerImage(img) {
    return Boolean(
      img.closest(".hero-single") ||
      img.closest(".hero-slider") ||
      img.closest(".navbar-brand") ||
      img.closest(".footer-logo"),
    );
  }

  function applyImagePerformanceDefaults() {
    var images = document.querySelectorAll("img");

    images.forEach(function (img) {
      if (!img.getAttribute("decoding")) {
        img.setAttribute("decoding", "async");
      }

      if (!img.getAttribute("loading")) {
        img.setAttribute("loading", isEagerImage(img) ? "eager" : "lazy");
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener(
      "DOMContentLoaded",
      applyImagePerformanceDefaults,
    );
  } else {
    applyImagePerformanceDefaults();
  }
})();
