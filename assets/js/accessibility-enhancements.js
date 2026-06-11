/**
 * Non-visual accessibility enhancements (carousel controls, etc.).
 */
(function () {
  "use strict";

  function labelOwlCarousel(root, labels) {
    if (!root) return;
    var prev = root.querySelector(".owl-prev");
    var next = root.querySelector(".owl-next");
    if (prev) {
      prev.setAttribute("type", "button");
      prev.setAttribute("aria-label", labels.prev);
    }
    if (next) {
      next.setAttribute("type", "button");
      next.setAttribute("aria-label", labels.next);
    }
    root.querySelectorAll(".owl-dot").forEach(function (dot, index) {
      dot.setAttribute("type", "button");
      dot.setAttribute("aria-label", labels.dot(index));
    });
  }

  function enhanceCarousels() {
    labelOwlCarousel(document.querySelector(".home3-reviews-slider"), {
      prev: "Previous testimonial",
      next: "Next testimonial",
      dot: function (i) {
        return "Show testimonial slide " + (i + 1);
      },
    });
    document
      .querySelectorAll(
        ".service-slider, .case-slider, .testimonial-slider, .partner-slider, .instagram-slider"
      )
      .forEach(function (el) {
        labelOwlCarousel(el, {
          prev: "Previous slide",
          next: "Next slide",
          dot: function (i) {
            return "Go to slide " + (i + 1);
          },
        });
      });
  }

  if (window.jQuery && window.jQuery.fn.owlCarousel) {
    window.jQuery(document).on("initialized.owl.carousel refreshed.owl.carousel", function (e) {
      if (!e.target) return;
      if (e.target.classList.contains("home3-reviews-slider")) {
        labelOwlCarousel(e.target, {
          prev: "Previous testimonial",
          next: "Next testimonial",
          dot: function (i) {
            return "Show testimonial slide " + (i + 1);
          },
        });
        return;
      }
      labelOwlCarousel(e.target, {
        prev: "Previous slide",
        next: "Next slide",
        dot: function (i) {
          return "Go to slide " + (i + 1);
        },
      });
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", enhanceCarousels);
  } else {
    enhanceCarousels();
  }
  window.addEventListener("load", enhanceCarousels);
})();
