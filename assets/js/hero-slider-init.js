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

  $(document).ready(function () {
    try {
      initHeroSlider();
    } catch (err) {
      showHeroFallback();
    }
  });
})(window.jQuery);
