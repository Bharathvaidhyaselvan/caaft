/**
 * Scroll to #contact_us / #quote-content and focus the "Your Name" field.
 * Standalone so it still runs if other main.js initializers fail on non-home pages.
 */
(function () {
  "use strict";

  var FORM_HASH_IDS = {
    contact_us: true,
    "quote-content": true,
  };

  function normalizePath(path) {
    if (!path) return "/";
    var p = path.replace(/\.php$/i, "");
    if (p.length > 1 && p.charAt(p.length - 1) === "/") {
      p = p.slice(0, -1);
    }
    return p || "/";
  }

  function headerOffset() {
    var header = document.querySelector(".header-sections .navbar");
    return header ? header.offsetHeight + 20 : 130;
  }

  function isFocusableField(el) {
    if (!el || el.disabled || el.type === "hidden") return false;
    if (el.classList.contains("hide-robot")) return false;
    if (el.getAttribute("aria-hidden") === "true") return false;
    var style = window.getComputedStyle(el);
    return style.display !== "none" && style.visibility !== "hidden";
  }

  function findNameField(section) {
    if (!section) return null;
    var byData = section.querySelector('[data-caaft-focus="name"]');
    if (byData && isFocusableField(byData)) return byData;
    var fields = section.querySelectorAll('input[name="name"]');
    for (var i = 0; i < fields.length; i++) {
      if (isFocusableField(fields[i])) return fields[i];
    }
    return null;
  }

  function focusNameField(sectionId) {
    if (!FORM_HASH_IDS[sectionId]) return false;
    var section = document.getElementById(sectionId);
    var field = findNameField(section);
    if (!field) return false;
    try {
      field.focus({ preventScroll: true });
    } catch (err) {
      field.focus();
    }
    return document.activeElement === field;
  }

  function scrollToSection(sectionId, behavior) {
    var el = document.getElementById(sectionId);
    if (!el) return false;
    var top =
      el.getBoundingClientRect().top +
      (window.pageYOffset || document.documentElement.scrollTop) -
      headerOffset();
    window.scrollTo({ top: Math.max(0, top), behavior: behavior || "auto" });
    return true;
  }

  function runFormHashFlow(sectionId, options) {
    if (!FORM_HASH_IDS[sectionId] || !document.getElementById(sectionId)) {
      return;
    }
    options = options || {};
    scrollToSection(sectionId, options.behavior || "auto");
    if (options.focusNow) focusNameField(sectionId);
    var delays = options.delays || [0, 120, 350, 650, 1000, 1400];
    delays.forEach(function (ms) {
      window.setTimeout(function () {
        focusNameField(sectionId);
      }, ms);
    });
  }

  function hashIdFromHref(href) {
    if (!href || href.indexOf("#") === -1) return null;
    try {
      var u = new URL(href, window.location.href);
      if (
        normalizePath(u.pathname) !== normalizePath(window.location.pathname)
      ) {
        return null;
      }
      if (!u.hash || u.hash.length < 2) return null;
      return u.hash.slice(1);
    } catch (err) {
      if (href.charAt(0) === "#" && href.length > 1) return href.slice(1);
      return null;
    }
  }

  function hashFromLocation() {
    var hash = window.location.hash;
    if (!hash || hash.length < 2) return null;
    return hash.slice(1);
  }

  function onPageLoadHash() {
    var id = hashFromLocation();
    if (!id || !FORM_HASH_IDS[id]) return;
    runFormHashFlow(id, { behavior: "auto", delays: [0, 150, 400, 750, 1100] });
  }

  document.addEventListener(
    "click",
    function (e) {
      var link = e.target.closest('a[href*="#"]');
      if (!link) return;
      var id = hashIdFromHref(link.getAttribute("href") || "");
      if (!id || !FORM_HASH_IDS[id] || !document.getElementById(id)) return;
      e.preventDefault();
      if (window.history && history.replaceState) {
        var href = link.getAttribute("href") || "";
        var path = href.split("#")[0].trim() || window.location.pathname;
        history.replaceState(null, "", path + "#" + id);
      }
      runFormHashFlow(id, {
        behavior: "smooth",
        focusNow: true,
        delays: [0, 80, 250, 500, 850, 1200],
      });
    },
    true,
  );

  window.addEventListener("hashchange", function () {
    var id = hashFromLocation();
    if (!id || !FORM_HASH_IDS[id]) return;
    runFormHashFlow(id, { behavior: "auto", delays: [0, 200, 500, 900] });
  });

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", onPageLoadHash);
  } else {
    onPageLoadHash();
  }
  window.addEventListener("load", onPageLoadHash);
  window.addEventListener("pageshow", function (ev) {
    if (ev.persisted) onPageLoadHash();
  });
})();
