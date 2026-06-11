/**
 * Defer WOW.js until after first paint to reduce main-thread reflow work.
 */
(function () {
  "use strict";

  if (!window.WOW || window.__caaftWowDeferred) {
    return;
  }
  window.__caaftWowDeferred = true;

  function initWow() {
    if (window.__caaftWowStarted) {
      return;
    }
    window.__caaftWowStarted = true;
    try {
      new window.WOW({
        boxClass: "wow",
        animateClass: "animated",
        offset: 0,
        mobile: true,
        live: false,
      }).init();
    } catch (err) {
      /* noop */
    }
  }

  if ("requestIdleCallback" in window) {
    window.requestIdleCallback(initWow, { timeout: 2500 });
  } else {
    window.addEventListener("load", function () {
      window.setTimeout(initWow, 200);
    });
  }
})();
