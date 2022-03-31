jQuery(document).ready(function ($) {
    // Declaration des fonction
    $.fn.disableScroll = function () {
        window.oldScrollPos = $(window).scrollTop();
        $(window).on('scroll.scrolldisabler', function (event) {
            $(window).scrollTop(window.oldScrollPos);
            event.preventDefault();
        });
    };

    $.fn.enableScroll = function () {
        $(window).off('scroll.scrolldisabler');
    };
    function disableScroll() {
        if ($('html').hasClass('scroll-lock')) {
            $('html').removeClass('scroll-lock');
            $('html').scrollTop(windowTop); //scroll to original position
        } else {
            windowTop = $(window).scrollTop();
            $('html').addClass('scroll-lock');
        }
    }
    function accordeons() {
        const bandeaux = $('.faq-bandeau');
        bandeaux.each(function () {
            const self = $(this);
            const header = self.find('.header');
            const content = self.find('.content');
            header.click(function () {
                self.addClass('trigger');
                bandeaux.each(function () {
                    if ($(this).hasClass('active') && !$(this).hasClass('trigger')) {
                        $(this).removeClass('active');
                        TweenLite.to($(this).find('.content'), 0.2, { height: 0 });
                    }
                });

                if (!self.hasClass('active')) {
                    self.addClass('active');
                    TweenLite.set(content, { height: 'auto' });
                    TweenLite.from(content, 0.2, { height: 0 });
                } else {
                    self.removeClass('active');
                    TweenLite.to(content, 0.2, { height: 0 });
                }
                self.removeClass('trigger');
            });

            self.hover(
                function () {
                    self.addClass('hover');
                },
                function () {
                    self.removeClass('hover');
                }
            );
        });
    }

    function numbers() {
        const $wrapper = $('.content__section[data-layout="statistique"]');
        const $top = $wrapper.find('.stats-number');
        $wrapper.each(function () {
            const digits = $(this).find('.solo');
            let started = false;
            $(window).on('scroll', function () {
                const sb = $(window).scrollTop() + $(window).innerHeight();
                if ($top.offset().top < sb + 100) {
                    if (!started) {
                        digits.each(function () {
                            const span = $(this).find('.stats-number');
                            const options = {
                                useEasing: true,
                                useGrouping: true,
                                separator: ' ',
                                decimal: '.',
                            };
                            span.each(function () {
                                const counter = new CountUp( $(this)[0], 0, $(this).attr('data-number'), 0, 2.5, options);
                                counter.start();
                                started = true;
                            });

                        });
                    }
                }
            });
        });
    }
    var isOpened = false;
    var triggerAnim = false;
    function mainNav() {
        var $burger = $('.burger-container');
        var barContainer = $burger.find('.burger');
        var barOne = barContainer.find('.bar:first-child');
        var barTwo = barContainer.find('.bar:nth-child(2)');
        var barThree = barContainer.find('.bar:last-child');
        var navMenu = $('.responsive-nav');
        var siteContent = $('.site__content');
        var reverse = false;
        var lastST = $(window).scrollTop();
        const startAnim = new TimelineLite({
            paused: true,
            onComplete: function () {
                // barContainer.addClass('active');
                // nextPart();
            },
        });
        startAnim
            .fromTo(barContainer, 0.15, { opacity: 1 }, { opacity: 0 }, 0)
            .to(barContainer, 0, { className: '+=active' }, 0.15)
            .to(barContainer, 0.15, { opacity: 1 }, 0.15);

        if ($('#masthead.reverse').length) {
            reverse = true;
        }

        $burger.click(function () {
            disableScroll();
            navMenu.toggleClass('active');
            // $burger.addClass('transition');
            // siteContent.toggleClass('hideSiteContent');
            if (reverse) {
                $('#masthead').toggleClass('reverse');
            }
            isOpened = !isOpened;
            triggerAnim = !triggerAnim;
            changeBurgerColor();

            if (triggerAnim) {
                startAnim.play();
            } else {
                startAnim.reversed(!startAnim.reversed());
                startAnim.reverse();
            }
        });
        if ($(window).width() < 1250) {
            $(window).on('scroll', function () {
                const st = $(window).scrollTop();
                if (st > lastST && st > 90) {
                    $burger.addClass('hidden');
                } else {
                    $burger.removeClass('hidden');
                }
                lastST = st;
            });
        }
    }

    function animeForm() {
        const form = $('.gform_body');
        const container = form.find('.gfield');

        container.each(function () {
            const self = $(this);
            const input = self.find('input, textarea');

            input.on({
                focus: function () {
                    self.addClass('active');
                    self.addClass('focus');
                },
                blur: function () {
                    if ($(this).val() == '') {
                        self.removeClass('active');
                    }
                    self.removeClass('focus');
                },
            });
        });
    }

    function lazyLoading() {
        const offsetAppear = $(window).height();
        const durationAppear = 1000;
        if ($('.lozad').length) {
            var productObserver = lozad('.lozad', {
                rootMargin: offsetAppear + 'px 0px',
                loaded: function (el) {
                    $(el).on('load', function () {
                        const item = $(this);
                        TweenLite.fromTo(
                            item,
                            durationAppear * 0.001,
                            { opacity: 0, visibility: 'hidden' },
                            { ease: Power4.easeOut, opacity: 1, visibility: 'visible' }
                        );
                    });
                },
            });
            productObserver.observe();
        }
    }
    function anchorPartners() {
        const button = $('.filter-button');
        button.each(function () {
            const self = $(this);
            const data = self.attr('data-term');
            const to = '#' + data;
            self.click(function () {
                $(to).animatescroll({ padding: 60 });
            });
        });
    }

    function hoverBlogCard() {
        const blogCard = $('.solo-event-article.blog');
        blogCard.each(function () {
            const self = $(this);
            const image = self.find('.image');
            const title = self.find('.content');
            image.add(title).hover(
                function () {
                    self.addClass('hover');
                },
                function () {
                    self.removeClass('hover');
                }
            );
        });
    }
    function hoverProjectCard() {
        const blogCard = $('.solo-project');
        blogCard.each(function () {
            const self = $(this);
            const hoverDiv = self.find('.hover-div');
            hoverDiv.hover(
                function () {
                    self.addClass('hover');
                },
                function () {
                    self.removeClass('hover');
                }
            );
        });
    }

    function changeBurgerColor() {
        const burger = $('.burger-container');
        const st = $(window).scrollTop();
        const bottomBurger = burger.offset().top + burger.height();
        const blueContainer = $('.burger-change');
        const footerblueContainer = $('.footer-burger-change');
        let trigger = false;

        blueContainer.each(function () {
            const containerTop = $(this).offset().top - 1;
            const containerBot = containerTop + $(this).outerHeight() - 1;
            //   if ((bottomBurger > containerTop && bottomBurger < containerBot) || (st > containerTop && st < containerBot)) {
            if (
                (st > containerTop && st < containerBot && bottomBurger < containerBot && bottomBurger > containerTop) ||
                st > footerblueContainer.offset().top
            ) {
                trigger = true;
            }
        });
        if (trigger && !isOpened) {
            burger.addClass('white');
        } else {
            burger.removeClass('white');
        }
        trigger = false;
    }

    function animeSelect() {
        const container = $('.solo-select');

        container.each(function () {
            const self = $(this);
            const input = self.find('select');
            if (input.children('option:selected').val().length) {
                self.addClass('active');
                self.addClass('focus');
            }
            // if(input[0].selectedIndex == 0){
            //   self.removeClass('active');
            // }

            input.on({
                focus: function () {
                    self.addClass('active');
                    self.addClass('focus');
                },
                blur: function () {
                    if ($(this).val() === null || $(this).val().length === 0) {
                        self.removeClass('active');
                    }
                    self.removeClass('focus');
                },
                keyup: function () {
                    if (input[0].selectedIndex == 0) {
                        self.removeClass('active');
                    }
                },
            });
        });
    }

    function smallHeroBackground() {
        if ($('#page__content > section.grey:first-child').length) {
            $('.grey-background').show();
        }
    }
    // Utilisation des fonctions
    $('#submit-news-letter-btn').click(function () {
        $('#mc-embedded-subscribe-form').submit();
    });

    function showScrollBar() {
        $scrollBar = $('section[data-layout=gallery] .carousel-scrollbar');
        setTimeout(function () {
            $scrollBar.show();
        }, 800);
    }

    mainNav();
    lazyLoading();
    changeBurgerColor();
    $(window).on({
        scroll: function () {
            changeBurgerColor();
        },
    });
    if ($('.faq-bandeau').length) {
        accordeons();
    }
    if ($('.carousel-scrollbar').length) {
        showScrollBar();
    }
    if ($('#page__header.small').length) {
        smallHeroBackground();
    }
    if ($('.custom-label').length) {
        animeSelect();
    }
    if ($('.solo-event-article.blog').length) {
        hoverBlogCard();
    }
    if ($('.solo-project').length) {
        hoverProjectCard();
    }
    if ($('.anchor-partner').length) {
        anchorPartners();
    }

    if ($('.gform_body').length) {
        animeForm();
    }
    if ($('.stats-number').length) {
        numbers();
    }
});
