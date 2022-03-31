(function ($) {
  var $doc = $(document);

  var touchingCarousel = false;
  var touchStartCoords;
  function toFlick() {
    document.body.addEventListener('touchstart', function(e) {
      if (e.target.closest('.flickity-slider')) {
        touchingCarousel = true;
      } else {
        touchingCarousel = false;
        return;
      }

      touchStartCoords = {
        x: e.touches[0].pageX,
        y: e.touches[0].pageY
      };
    });

    document.body.addEventListener('touchmove', function(e) {
      if (!(touchingCarousel && e.cancelable)) {
        return;
      }

      var moveVector = {
        x: e.touches[0].pageX - touchStartCoords.x,
        y: e.touches[0].pageY - touchStartCoords.y
      };

      if (Math.abs(moveVector.x) > 7) { e.preventDefault(); }
    }, { passive: false });

    /**
     * Slider
     */

    var $thumbnails = $('.highlight-thumbs').flickity({
      cellSelector: '.carousel-cell',
      cellAlign: 'left',
      freeScroll: true,
      contain: true,
      pageDots: false,
      prevNextButtons: false,
      wrapAround: false,
      touchVerticalScroll: false,
      imagesLoaded: true
    });

    /**
       * Slider Scrollbar
       */
    var $scroll = $thumbnails.find('.carousel-scrollbar');
    var $scrollInner = $scroll.find('.carousel-scrollbar-inner');
    var flkty = $thumbnails.data('flickity');

    // recalculate scrollbar size
    var scrollInnerSize = 0;
    var recalculateScrollSizeTimeout;
    function recalculateScrollSize() {
      clearTimeout(recalculateScrollSizeTimeout);
      recalculateScrollSizeTimeout = setTimeout(function() {
        $scrollInner.width(flkty.size.width * flkty.size.width / flkty.slideableWidth);

        // hide scrollbar if don't needed
        if (flkty.size.width >= flkty.slideableWidth) {
          $scroll.addClass('is-hidden');
        } else {
          $scroll.removeClass('is-hidden');
        }

        scrollInnerSize = $scrollInner.width() / $scroll.width();
      }, 155); // flickity has debounce 150ms
    }
    recalculateScrollSize();
    $thumbnails.on('ready.flickity change.flickity', recalculateScrollSize);
    $(window).on('ready load resize orientationchange', recalculateScrollSize);

    // set scrollbar position
    $thumbnails.on('scroll.flickity', function(event, progress) {
      $scrollInner.css({
        left: (progress * (1 - scrollInnerSize)) * 100 + '%'
      });
    });
    $thumbnails.flickity('reposition');

    // scrollbar drag event.
    var lastPageX = 0;
    var lastThumbsX = 0;
    function drag(e) {
      e.preventDefault();
      var delta = e.pageX - lastPageX;

      flkty.x = lastThumbsX - (flkty.slideableWidth * delta / flkty.size.width);

      if (!flkty.isFreeScrolling) {
        flkty.animate();
      }
    }
    function stop(e) {
      e.preventDefault();
      $doc.off('mousemove', drag);
      $doc.off('mouseup', stop);

      if (flkty.options.freeScroll) {
        flkty.isFreeScrolling = true;
      }

      // set selectedIndex based on where flick will end up
      var index = flkty.dragEndRestingSelect();

      if (flkty.options.freeScroll && !flkty.options.wrapAround) {
        // if free-scroll & not wrap around
        // do not free-scroll if going outside of bounding slides
        // so bounding slides can attract slider, and keep it in bounds
        var restingX = flkty.getRestingPosition();
        flkty.isFreeScrolling = -restingX > flkty.slides[0].target && -restingX < flkty.getLastSlide().target;
      }

      flkty.select(index);
    }
    $scrollInner.on('mousedown', function(e) {
      e.preventDefault();

      lastPageX = e.pageX;
      lastThumbsX = flkty.x;

      flkty.isFreeScrolling = true;
      flkty.startAnimation();

      $doc.on('mousemove', drag);
      $doc.on('mouseup', stop);
    });
  }

  if ($('.highlight-thumbs').length) {
    toFlick();
  }
}(jQuery));
