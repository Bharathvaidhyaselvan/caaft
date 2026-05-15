(function () {
  "use strict";

  function isEagerImage(img) {
    return Boolean(
      img.closest(".hero-single") ||
      img.closest(".hero-slider") ||
      img.closest(".navbar-brand") ||
      img.closest(".footer-logo") ||
      img.getAttribute("fetchpriority") === "high",
    );
  }

  function reserveSpace(img) {
    if (img.hasAttribute("width") && img.hasAttribute("height")) {
      return;
    }

    var w = parseInt(img.getAttribute("width") || "", 10);
    var h = parseInt(img.getAttribute("height") || "", 10);

    if (!w || !h) {
      if (img.closest(".navbar-brand.fixed_logo")) {
        w = 160;
        h = 62;
      } else if (img.closest(".navbar-brand")) {
        w = 150;
        h = 132;
      } else if (img.closest(".hero-img")) {
        w = 600;
        h = 500;
      }
    }

    if (w && h && !img.closest(".navbar-brand")) {
      img.setAttribute("width", String(w));
      img.setAttribute("height", String(h));
      img.style.aspectRatio = w + " / " + h;
    }
  }

  function applyImagePerformanceDefaults() {
    document.querySelectorAll("img").forEach(function (img) {
      reserveSpace(img);

      if (!img.getAttribute("decoding")) {
        img.setAttribute("decoding", "async");
      }

      if (!img.getAttribute("loading")) {
        img.setAttribute("loading", isEagerImage(img) ? "eager" : "lazy");
      }

      if (isEagerImage(img) && !img.getAttribute("fetchpriority")) {
        img.setAttribute("fetchpriority", "high");
      }
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", applyImagePerformanceDefaults);
  } else {
    applyImagePerformanceDefaults();
  }
})();
