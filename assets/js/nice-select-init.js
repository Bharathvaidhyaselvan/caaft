(function ($) {
  "use strict";
  if (!$.fn.niceSelect) {
    return;
  }

  $(".select").niceSelect();

  // nice-select updates the native <select> via jQuery.trigger("change"), which does not
  // always reach addEventListener handlers — dispatch a native change after selection.
  $(document).on("click.caaft_nice_select_sync", ".nice-select .option:not(.disabled)", function () {
    var select = $(this).closest(".nice-select").prev("select")[0];
    if (!select) {
      return;
    }
    window.setTimeout(function () {
      select.dispatchEvent(new Event("change", { bubbles: true }));
    }, 0);
  });
})(window.jQuery);
