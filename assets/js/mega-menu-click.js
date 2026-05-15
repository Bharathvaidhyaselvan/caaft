(function () {
  "use strict";

  var DESKTOP_BREAKPOINT = 992;
  var serviceItems = document.querySelectorAll(".nav-item.mega-services-item");
  var legacyWrappers = document.querySelectorAll(
    ".main-menu .mega-menu-wrap.dispaly_desktop",
  );
  var mainNavigation = document.querySelector(".main-navigation");

  if (!serviceItems.length && !legacyWrappers.length) return;

  function isDesktop() {
    return window.innerWidth >= DESKTOP_BREAKPOINT;
  }

  function getOpenTargets() {
    return serviceItems.length ? serviceItems : legacyWrappers;
  }

  function setMegaMenuOpenState(open) {
    if (mainNavigation) {
      mainNavigation.classList.toggle("mega-menu-open", open);
    }
  }

  function closeAll() {
    getOpenTargets().forEach(function (item) {
      item.classList.remove("is-open");
      var trigger = item.querySelector(".mega-services-trigger, a.nav-link");
      if (trigger) {
        trigger.setAttribute("aria-expanded", "false");
      }
    });
    setMegaMenuOpenState(false);
  }

  function getMegaAnchor() {
    var navbar = document.querySelector(".main-navigation .navbar");
    if (navbar && navbar.classList.contains("fixed-top")) {
      return navbar;
    }
    return document.querySelector(".header") || navbar;
  }

  function updateMegaMenuPosition() {
    if (!isDesktop()) return;

    var anchorEl = getMegaAnchor();
    var container = document.querySelector(".main-navigation .navbar .container");
    if (!anchorEl) return;

    var anchorRect = anchorEl.getBoundingClientRect();
    document.documentElement.style.setProperty(
      "--caaft-mega-top",
      anchorRect.bottom + "px",
    );

    if (container) {
      var containerRect = container.getBoundingClientRect();
      document.documentElement.style.setProperty(
        "--caaft-mega-left",
        containerRect.left + "px",
      );
      document.documentElement.style.setProperty(
        "--caaft-mega-width",
        containerRect.width + "px",
      );
    }
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", updateMegaMenuPosition);
  } else {
    updateMegaMenuPosition();
  }

  window.addEventListener("resize", function () {
    updateMegaMenuPosition();
    if (!isDesktop()) {
      closeAll();
    }
  });
  window.addEventListener("scroll", updateMegaMenuPosition, { passive: true });

  var navbar = document.querySelector(".main-navigation .navbar");
  if (navbar && typeof MutationObserver !== "undefined") {
    new MutationObserver(updateMegaMenuPosition).observe(navbar, {
      attributes: true,
      attributeFilter: ["class"],
    });
  }

  getOpenTargets().forEach(function (wrap) {
    var trigger = wrap.querySelector(
      ".mega-services-trigger, a.nav-link.dropdown-toggle, a.nav-link[aria-haspopup]",
    );
    var menu = wrap.querySelector(".mega-menu-new");
    if (!trigger) return;

    if (menu) {
      menu.addEventListener("click", function (event) {
        event.stopPropagation();
      });
    }

    trigger.addEventListener("click", function (event) {
      if (!isDesktop()) return;

      event.preventDefault();
      event.stopPropagation();

      var willOpen = !wrap.classList.contains("is-open");
      closeAll();
      if (willOpen) {
        updateMegaMenuPosition();
        wrap.classList.add("is-open");
        trigger.setAttribute("aria-expanded", "true");
        setMegaMenuOpenState(true);
      }
    });
  });

  document.addEventListener("click", function (event) {
    if (!isDesktop()) return;

    var clickedInside = false;
    getOpenTargets().forEach(function (wrap) {
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

  /* Sidebar tab switching (click, not hover) */
  var tabs = document.querySelectorAll(".mm-tab[data-panel]");
  var panels = document.querySelectorAll(".mm-panel");

  function activateTab(tab) {
    tabs.forEach(function (t) {
      t.classList.remove("is-active");
      t.setAttribute("aria-selected", "false");
    });
    panels.forEach(function (p) {
      p.classList.remove("is-active");
    });

    tab.classList.add("is-active");
    tab.setAttribute("aria-selected", "true");
    var target = document.getElementById("panel-" + tab.dataset.panel);
    if (target) {
      target.classList.add("is-active");
    }
  }

  tabs.forEach(function (tab) {
    tab.addEventListener("click", function (event) {
      event.preventDefault();
      event.stopPropagation();
      activateTab(tab);
    });
    tab.addEventListener("keydown", function (event) {
      if (event.key === "Enter" || event.key === " ") {
        event.preventDefault();
        activateTab(tab);
      }
    });
  });
})();
