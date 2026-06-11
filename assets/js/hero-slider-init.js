(function ($) {
  "use strict";

  if (!$ || !$.fn || !$.fn.owlCarousel) {
    return;
  }

  function initHeroSlider() {
    var $hero = $(".hero-slider");
    if (!$hero.length || $hero.hasClass("owl-loaded")) {
      return;
    }

    $hero.owlCarousel({
      loop: true,
      nav: false,
      dots: false,
      margin: 0,
      autoplay: true,
      autoplayTimeout: 7000,
      smartSpeed: 800,
      items: 1,
    });
  }

  function showHeroFallback() {
    var slider = document.querySelector(".hero-slider.owl-carousel");
    if (!slider || slider.classList.contains("owl-loaded")) {
      return;
    }
    slider.classList.add("hero-slider-fallback");
  }

  function scheduleHeroSlider() {
    var isMobile = window.matchMedia("(max-width: 767px)").matches;
    if (isMobile) {
      window.addEventListener(
        "load",
        function () {
          window.setTimeout(initHeroSlider, 800);
        },
        { once: true },
      );
      return;
    }
    initHeroSlider();
  }

  $(document).ready(function () {
    try {
      scheduleHeroSlider();
    } catch (err) {
      showHeroFallback();
    }
  });
})(window.jQuery);
