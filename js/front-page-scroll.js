jQuery(document).ready(function ($) {
    const statisticSection = 4;
    $(function () {
        var pagePosition = 0;
        var sectionsSeclector = 'section';
        var $scrollItems = $(sectionsSeclector);
        var pageMaxPosition = $scrollItems.length - 1;
        var animating = false;
        var scrollContainer = $('.scroll-bar-fp');
        var point = scrollContainer.find('.point-container');
        var statsTrigger = true;
        // Map the sections:
        $scrollItems.each(function (index, ele) { $(ele).attr('debog', index).data('pos', index); });

        if ($('#front-page-full').length) {
            //  $(document).on('DOMMouseScroll mousewheel', scrollPage);
            $(window).on('wheel', scrollPage);
            scrollButton();
        }
        function scrollButton() {
            point.each(function () {
                let self = $(this);
                let position = parseInt(self.attr('data-pos'));
                self.click(function () {
                    point.removeClass('active');
                    self.addClass('active');
                    fadeSectionsButton(position);
                });
            });
        }

        function fadeSections(isScrollingDown) {
            point.removeClass('active');
            $scrollItems.eq(pagePosition).removeClass('front-index');
            $scrollItems.eq(pagePosition).animate({
                opacity: 0
            }, 50, function () {
                if (isScrollingDown) {
                    pagePosition++;
                } else {
                    pagePosition--;
                    $('#front-page-footer').css("display", "none");
                }
            }).promise().then(function () {
                $('.point-container[data-pos="' + pagePosition + '"]').addClass('active');
                $scrollItems.eq(pagePosition).addClass('front-index');
                $scrollItems.eq(pagePosition).fadeTo(50, 1).promise().then(function () {
                    if (pagePosition === statisticSection && statsTrigger) {
                        animateCount();
                    }
                    animating = false;
                    resizeOwl();
                });
            });
        }
        function fadeSectionsButton(nextPosition) {
            $scrollItems.eq(pagePosition).removeClass('front-index');
            $scrollItems.eq(pagePosition).animate({
                opacity: 0
            }, 50, function () {
                pagePosition = nextPosition;
                if (nextPosition != 4) {
                    $('#front-page-footer').css("display", "none");
                }
            }).promise().then(function () {
                $scrollItems.eq(pagePosition).addClass('front-index');
                $scrollItems.eq(pagePosition).fadeTo(50, 1).promise().then(function () {
                    if (pagePosition === statisticSection && statsTrigger) {
                        animateCount();
                    }
                    animating = false;
                    resizeOwl();
                });
            });
        }

        function scrollPage(e) {
            if (!window.matchMedia('screen and (max-width: 1250px)').matches) {
                if (animating) {
                    return false;
                }
                animating = true;
                if (e.originalEvent.deltaY > 0 && pagePosition + 1 <= pageMaxPosition) {
                    fadeSections(true);
                }
                if (e.originalEvent.deltaY < 0 && pagePosition - 1 >= 0) {
                    if (pagePosition - 1 == 4) {
                        animating = true;
                        var $win = $(window);
                        if ($win.scrollTop() == 0) {
                            fadeSections(false);
                        } else {
                            animating = false;
                        }
                    } else {
                        fadeSections(false);
                    }
                }
                if (e.originalEvent.deltaY > 0 && pagePosition === pageMaxPosition) {
                    animating = false;
                }
                if (e.originalEvent.deltaY < 0 && pagePosition === 0) {
                    animating = false;
                }
            }
        }
        function resizeOwl() {
            window.dispatchEvent(new Event('resize'));
        }

        function animateCount() {
            const $wrapper = $('.content__section[data-layout="statistique"]');
            $wrapper.each(function () {
                const digits = $(this).find('.solo');
                let started = false;
                if (!started) {
                    digits.each(function () {
                        const span = $(this).find('.stats-number');
                        const options = {
                            useEasing: true,
                            useGrouping: true,
                            separator: ' ',
                            decimal: '.'
                        };
                        // eslint-disable-next-line no-undef
                        const counter = new CountUp(span[0], 0, span.attr('data-number'), 0, 2.5, options);

                        counter.start();
                        started = true;
                    });
                }
            });
            statsTrigger = false;
        }
    });
});
