jQuery(document).ready(function ($) {
    function is_touch_enabled() {
        return ('ontouchstart' in window) ||
            (navigator.maxTouchPoints > 0) ||
            (navigator.msMaxTouchPoints > 0);
    }

    // ouvrir accordéon lorsqu'il est ancré 
    if(window.location.hash) {
        $( "#" + window.location.hash.substr(1) + " .header" ).trigger("click");
    }
    
    // Soulignement menus

    $('.responsive-nav .sub-menu li a[aria-current=page]').each(function () {
        if ($(this).attr('href') != window.location.href) {
            $(this).addClass('no_underscore');
        }
    });

    $('.responsive-nav .sub-menu a').on('click', function () {
        $('.burger-container').trigger('click');
        let url = $(this).attr('href');
        const n = url.indexOf('#');
        url = "[data-name='" + url.substring(n + 1) + "']";
        $(url).trigger('click');
        setTimeout(function () {
            $('.responsive-nav .sub-menu li a').each(function () {
                if ($(this).attr('href') != window.location.href) {
                    $(this).addClass('no_underscore');
                } else {
                    $(this).removeClass('no_underscore');
                }
            });
        }, 500);
    });

    $('#close-form-button').on('click', function () {
        setTimeout(function () {
            $('.responsive-nav .sub-menu li a[aria-current=page]').each(function () {
                if ($(this).attr('href') != window.location.href) {
                    $(this).addClass('no_underscore');
                }
            });
        }, 500);
    });

    // $(".responsive-nav li a[aria-current=page]").parent().parent().find('a').eq(0).removeClass("no_underscore");

    if (is_touch_enabled()) {
        // sous-menus pour touch device
        $('.menu-item > a').on('click', function (event) {
            if ($(this).parent().find('.sub-menu')[0]) {
                if ($(this).parent().find('.sub-menu').length && ! $(this).parent().hasClass('hover') ) {
                    event.preventDefault();
                    $('.menu-item').removeClass('hover');
                    $(this).parent().addClass('hover');
                }
            } else {
                window.location.href = $(this).attr('href');
                return false;
            }
        });

        // Survol logos sur touch device

        $('.solo-logo.item-ajax').on('click', function (event) {
            if (!$(this).hasClass('hover')) {
                event.preventDefault();
                $('.solo-logo.item-ajax').removeClass('hover');
                $(this).addClass('hover');
                $(this).trigger('hover');
            }
        });
    } else {
        $('.sub-menu a').on('click', function (event) {
            window.location.href = $(this).attr('href');
            return false;
        });
    }

    //* *****     Nombre mots maximum et minimum dans champs     ****************/

    function nombreMots(el) {
        if (el.val() == '') {
            return 0;
        }
        var words = el.val().trim().split(' ');
        return words.length;
    }

    function afficheManquantsTrop(min, max, actuel) {
        console.log( min + " " + max + " " + actuel );
        var texte = '';
        var pluriel = '';
        if (actuel < min) {
            texte = min - actuel;
            if (texte > 1) {
                pluriel = 's';
            }
            
            texte = texte + ' mot' + pluriel + ' manquant' + pluriel;
        } else if (actuel > max) {
            texte = actuel - max;
            if (texte > 1) {
                pluriel = 's';
            }
            texte = texte + ' mot' + pluriel + ' en trop';
        } else {
            if (actuel > 1) {
                pluriel = 's';
            }
            texte = actuel + ' mot' + pluriel;
        }
        return texte;
    }

    if ($('.min-max')[0]) {
        $('.min-max').each(function () {
            var minMots = 0;
            if ($(this).hasClass('min')) {
                minMots = $(this).attr('class').match(/min_[\w-]*\b/).toString().substring(4);
            }
            var maxMots = 0;
            if ($(this).hasClass('max')) {
                maxMots = $(this).attr('class').match(/max_[\w-]*\b/).toString().substring(4);
            }
            var motRequis = 0;
            var texte = "<div class='nombre-mots'><span class='nb_mots'></span><span class='mots-manquants-trop'></span></div>";
            $(this).find('.ginput_container').append(texte);
            $(this).find('textarea').on('focus', function () {
                $(this).parent().parent().find('.validation_message').addClass('hide');
                $(this).parent().find('.nombre-mots').addClass('show');
                $(this).parent().find('.mots-manquants-trop').text(afficheManquantsTrop(minMots, maxMots, nombreMots($(this))));
                $(this).on('change keyup paste', function () {
                    $(this).parent().find('.mots-manquants-trop').text(afficheManquantsTrop(minMots, maxMots, nombreMots($(this))));
                });
            });
        });
    }

    //* *****     Popup Contactez-nous    ****************/
    if ($('.bouton_popup')[0]) {
        $('.bouton_popup').on('click', function () {
            $(this).find('.popup_conditions').toggleClass('montre');
            $('.film').toggleClass('montre');
        });
    }

    //* ***********    Liens externes    **************/

    $.expr[':'].external = function (obj) {
        return !obj.href.match(/^mailto\:/) &&
            (obj.hostname != location.hostname) &&
            !obj.href.match(/^javascript\:/) &&
            !obj.href.match(/^$/);
    };

    $('a:external').attr('target', '_blank');

    //*************   Accordéon fixe   **************/
    $('.faq-bandeau').on('click', function () {
        var offset = $(this).offset();
        var posY = offset.top - $(window).scrollTop();
        var bandeau = $(this);
        setTimeout(function () {
            var haut = bandeau.offset().top;
            $('html, body').animate({
                scrollTop: haut - posY
            }, 200);
        }, 250);
    });
    //*************   Popup explication catégories membres industriels   **************/
    $(".solo-select.cat .fa-question-circle").on("click", function() {
        $(".liste-description").addClass("montre");
        $(".film").addClass("montre");
    });
    $(".film, .liste-description").on("click", function() {
        $(".liste-description").removeClass("montre");
        $(".film").removeClass("montre");
    });

    /********** Déroulement de la page Connaissance lorsqu'il y a une catégorie dasn le url ********/
    if ($('.post-type-archive-projects')[0] && window.location.search) {
            $("html, body").animate({
                scrollTop: $(".filters-container").offset().top
            }, 500);
    }  

    /********** Responsive youtube iframe ***********************/
    $('iframe[src*="youtube.com"]').each(function() { 
        $(this).parent().addClass("youtube-responsive-container");
    });

    /********************* Search *******************/
    $("#search-form").on( 'click', function() {
        $( '.search-form' ).toggleClass( 'show' );
        return false;
    });

    /********************* Animation *******************/
    AOS.init();
});
