(function ($) {
  "use strict";

  if (!$ || !$.fn) {
    return;
  }

  function setNavbarHeightVar() {
    var nav = document.querySelector(".main-navigation .navbar");
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
    setNavbarHeightVar();
    var isSticky = $(window).scrollTop() > 50;
    $nav.toggleClass("fixed-top", isSticky);
    document.body.classList.toggle("navbar-is-sticky", isSticky);
  }

  $(window).on("scroll", updateStickyNavbar);
  $(document).ready(function () {
    setNavbarHeightVar();
    updateStickyNavbar();
  });
  $(window).on("resize", setNavbarHeightVar);
})(window.jQuery);
