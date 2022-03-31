jQuery(document).ready(function ($) {
  if ($('#contact-page-full').length) {
    window.onhashchange = function () {
      location.reload();
    };
  }
});
