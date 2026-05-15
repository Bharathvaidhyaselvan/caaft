(function ($) {
  "use strict";

  if (!$ || !$.fn) {
    return;
  }

  function setHeaderHeightVars() {
    var header = document.querySelector(".header");
    var nav = document.querySelector(".main-navigation .navbar");
    if (header) {
      var headerHeight = header.offsetHeight;
      if (nav && window.matchMedia("(max-width: 991.98px)").matches) {
        var headerTop = header.getBoundingClientRect().top;
        var navBottom = nav.getBoundingClientRect().bottom;
        headerHeight = Math.max(headerHeight, Math.ceil(navBottom - headerTop));
      }
      document.documentElement.style.setProperty(
        "--caaft-header-height",
        headerHeight + "px",
      );
    }
    if (nav) {
      document.documentElement.style.setProperty(
        "--caaft-navbar-height",
        nav.offsetHeight + "px",
      );
    }
  }

  function updateStickyNavbar() {
    var $nav = $(".main-navigation .navbar");
    if (!$nav.length) {
      return;
    }
    setHeaderHeightVars();
    var scrollTop =
      window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop ||
      0;
    var isSticky = scrollTop > 50;
    $nav.toggleClass("fixed-top", isSticky);
    document.body.classList.toggle("navbar-is-sticky", isSticky);
  }

  $(window).on("scroll", updateStickyNavbar);
  $(document).ready(function () {
    setHeaderHeightVars();
    updateStickyNavbar();
  });
  $(window).on("resize", setHeaderHeightVars);
})(window.jQuery);
