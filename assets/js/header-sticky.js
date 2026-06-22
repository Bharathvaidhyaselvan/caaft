(function ($) {
  "use strict";

  if (!$ || !$.fn) {
    return;
  }

  function setHeaderHeightVars() {
    var header = document.querySelector(".header");
    var nav = document.querySelector(".main-navigation .navbar");
    var isMobile = window.matchMedia("(max-width: 991.98px)").matches;

    if (nav) {
      document.documentElement.style.setProperty(
        "--caaft-navbar-height",
        nav.offsetHeight + "px",
      );
    }

    if (header) {
      var headerHeight = header.offsetHeight;
      if (nav && isMobile) {
        var headerTopBar = header.querySelector(".header-top");
        var topBarHeight = headerTopBar ? headerTopBar.offsetHeight : 0;
        var navHeight = nav.offsetHeight;
        var hasHeaderSections = !!document.querySelector(".header-sections");

        if (hasHeaderSections) {
          headerHeight = navHeight + topBarHeight;
        } else {
          headerHeight = navHeight;
        }
      }
      document.documentElement.style.setProperty(
        "--caaft-header-height",
        headerHeight + "px",
      );
    }
  }

  function updateStickyNavbar() {
    var $nav = $(".main-navigation .navbar");
    if (!$nav.length) {
      return;
    }

    var scrollTop =
      window.pageYOffset ||
      document.documentElement.scrollTop ||
      document.body.scrollTop ||
      0;
    var isMobile = window.matchMedia("(max-width: 991.98px)").matches;
    var isSticky = isMobile || scrollTop > 50;

    $nav.toggleClass("fixed-top", isSticky);
    document.body.classList.toggle("navbar-is-sticky", isSticky);
    setHeaderHeightVars();
  }

  $(window).on("scroll", updateStickyNavbar);
  $(document).ready(function () {
    setHeaderHeightVars();
    updateStickyNavbar();
  });
  $(window).on("resize", setHeaderHeightVars);
})(window.jQuery);
