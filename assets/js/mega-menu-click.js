(function () {
  "use strict";

  var DESKTOP_BREAKPOINT = 992;
  var wrappers = document.querySelectorAll(
    ".main-menu .mega-menu-wrap.dispaly_desktop",
  );
  if (!wrappers.length) return;

  function isDesktop() {
    return window.innerWidth >= DESKTOP_BREAKPOINT;
  }

  function closeAll() {
    wrappers.forEach(function (item) {
      item.classList.remove("is-open");
    });
  }

  /** Keeps mega menu attached right below navbar (normal + sticky). */
  function updateMegaMenuTop() {
    if (!isDesktop()) return;
    var navbar = document.querySelector(".main-navigation .navbar");
    var anchorEl = navbar || document.querySelector(".header");
    if (!anchorEl) return;
    var gapPx = 0;
    var topPx = anchorEl.getBoundingClientRect().bottom + gapPx;
    document.documentElement.style.setProperty(
      "--caaft-mega-top",
      topPx + "px",
    );
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", updateMegaMenuTop);
  } else {
    updateMegaMenuTop();
  }
  window.addEventListener("resize", function () {
    updateMegaMenuTop();
    if (!isDesktop()) {
      closeAll();
    }
  });
  window.addEventListener("scroll", updateMegaMenuTop, { passive: true });

  wrappers.forEach(function (wrap) {
    var trigger = wrap.querySelector("a.nav-link.dropdown-toggle");
    if (!trigger) return;

    trigger.addEventListener("click", function (event) {
      if (!isDesktop()) return;

      event.preventDefault();
      event.stopPropagation();

      var willOpen = !wrap.classList.contains("is-open");
      closeAll();
      if (willOpen) {
        updateMegaMenuTop();
        wrap.classList.add("is-open");
      }
    });
  });

  document.addEventListener("click", function (event) {
    if (!isDesktop()) return;

    var clickedInside = false;
    wrappers.forEach(function (wrap) {
      if (wrap.contains(event.target)) {
        clickedInside = true;
      }
    });

    if (!clickedInside) {
      closeAll();
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key === "Escape") {
      closeAll();
    }
  });
})();
