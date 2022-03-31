jQuery(document).ready(function ($) {
  const carouselsSpeed = 5000;

  function carousels() {
    const carousels = $('.carousel');
    const carOpts = {
      front: {
        items: 1,
        autoplay: true,
        autoplayHoverPause: true,
        autoplayTimeout: carouselsSpeed,
        loop: true
      }
    };
    carousels.each(function () {
      const $carouselWrapper = $(this).find('.carousel-wrapper');
      const $arrows = $(this).find('.carousel-arrow');
      const opts = carOpts[$carouselWrapper.attr('data-slider')];

      $carouselWrapper.owlCarousel(opts);

      $arrows.on({
        click: function () {
          $carouselWrapper.trigger('stop.owl.autoplay');

          if ($(this).hasClass('next')) {
            $carouselWrapper.trigger('next.owl.carousel');
            $carouselWrapper.trigger('play.owl.autoplay');
          } else {
            $carouselWrapper.trigger('prev.owl.carousel');
            $carouselWrapper.trigger('play.owl.autoplay');
          }
        }
      });
    });
  }

  if ($('.carousel').length) {
    carousels();
  }
});
