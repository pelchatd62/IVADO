jQuery(document).ready(function ($) {
    /*function resultsAjax() {
        const container = $('#results-ajax');
        const filters = $('#results-form select');
        let form = $('#search-form.results');
        function removeBox(call, val) {
            const timeline = new TimelineLite({
                onStart: function () {
                    container.css('height', container.innerHeight());
                },
                onComplete: function () {
                    container.find('.item-ajax').remove();
                    if (call == "filter") {
                        resultsFilter();
                    }
                    if (call == "resetData") {
                        resetData();
                    }
                    if (call == "byName") {
                        searchCall(val);
                    }
                },
            });
            timeline
                .to(container, 0.3, { y: 25, opacity: 0 });
        }

        function initializeButton() {
            var buttonReset = container.find('#reset-button');
            buttonReset.on('click', function () {
                let call = "resetData";
                removeBox(call);
            });
        }

        function accordeons() {
            const bandeaux = $('.faq-bandeau');
            bandeaux.each(function () {
                const self = $(this);
                const header = self.find('.header');
                const content = self.find('.content');
                let isOpened = false;
                if (self.hasClass("first")) {
                    isOpened = true;
                }
                header.click(function () {
                    self.toggleClass('active');
                    if (!isOpened) {
                        TweenLite.set(content, { height: 'auto' });
                        TweenLite.from(content, 0.2, { height: 0 });
                    } else {
                        TweenLite.to(content, 0.2, { height: 0 });
                    }
                    isOpened = !isOpened;
                });
            });
        }

        function searchCall(val) {
            filters.prop('selectedIndex', 0);
            const data = {
                run: 'searchCall',
                action: 'resultCall',
                posts: val
            };
            var realurl = '';
            $.ajax({ // you can also use $.post here
                url: resultInfo.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                success: function (data) {
                    if (data) {
                        if (val != '') {
                            realurl = '?partner-name=' + val;
                            window.history.pushState("", "", realurl);
                        } if (val === "") {
                            window.history.replaceState({}, '', location.pathname);
                        }
                        let timeline = new TimelineLite({
                            onStart: function () {
                                container.append(data);
                                container.css('height', 'auto');
                            },
                            onComplete: function () {
                                initializeButton();
                                accordeons();
                            },
                        });
                        timeline
                            .to(container, .3, { y: 0, opacity: 1 });
                    }
                }
            });
        }

        function resetData() {
            form.find('.result-name').val('');
            filters.prop('selectedIndex', 0);
            const data = {
                run: 'resetCall',
                action: 'resultCall',
                posts: resultInfo.posts
            };
            $.ajax({ // you can also use $.post here
                url: resultInfo.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                success: function (data) {
                    if (data) {
                        window.history.replaceState({}, '', location.pathname);
                        let timeline = new TimelineLite({
                            onStart: function () {
                                container.append(data);
                                container.css('height', 'auto');
                            },
                            onComplete: function () {
                                accordeons();
                            },
                        });

                        timeline
                            .to(container, 0.3, { y: 0, opacity: 1 });
                    }
                }
            });
        }

        function resultsFilter() {
            form.find('.result-name').val('');
            const data = {
                run: 'resultsFilter',
                action: 'resultCall',
                posts: resultInfo.posts,
                selects: {}
            };
            var newUrl = [];
            var posi = 1;
            var realurl = '';
            filters.each(function () {
                const keyToModif = $(this).attr('name');
                const key = keyToModif.substring(0, keyToModif.length - 1);
                const val = $(this).val();
                data.selects[key] = val;
                if (val != '' && posi == 1) {
                    newUrl.push(keyToModif + '=' + val);
                }
                if (val != '' && posi != 1) {
                    newUrl.push('&' + keyToModif + '=' + val);
                }
                posi++;
            });
            for (i = 0; i < newUrl.length; i++) {
                realurl += newUrl[i];
            }
            $.ajax({
                url: resultInfo.ajaxurl,
                data: data,
                type: 'POST',
                // beforeSend: function(xhr) {
                // initializeButton();
                // },
                success: function (data) {
                    if (data) {
                        window.history.pushState('', '', '?' + realurl);
                        let timeline = new TimelineLite({
                            onStart: function () {
                                container.append(data);
                                container.css('height', 'auto');
                            },
                            onComplete: function () {
                                initializeButton();
                                accordeons();
                            },
                        });
                        timeline
                            .to(container, 0.3, { y: 0, opacity: 1 });
                        accordeons();
                    }
                }
            });
        }

        filters.change(function () {
            let call = "filter";
            removeBox(call);
            // partnerFilter();
        });

        form.find('.custom-submit').click(function (e) {
            form.submit();
        });

        form.submit(function (e) {
            e.preventDefault();
            let searchVal = form.find('.result-name').val();
            let call = "byName";
            removeBox(call, searchVal)
        });
    }
    if ($('#results-form').length) {
        resultsAjax();
    }*/
    $.fn.highlight = function (pat) {
        function innerHighlight(node, pat) {
            var skip = 0;
            if (node.nodeType == 3) {
                var pos = node.data.toUpperCase().indexOf(pat);
                pos -= (node.data.substr(0, pos).toUpperCase().length - node.data.substr(0, pos).length);
                if (pos >= 0) {
                    var spannode = document.createElement('span');
                    spannode.className = 'highlight';
                    var middlebit = node.splitText(pos);
                    var endbit = middlebit.splitText(pat.length);
                    var middleclone = middlebit.cloneNode(true);
                    spannode.appendChild(middleclone);
                    middlebit.parentNode.replaceChild(spannode, middlebit);
                    skip = 1;
                }
            } else if (node.nodeType == 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
                for (var i = 0; i < node.childNodes.length; ++i) {
                    i += innerHighlight(node.childNodes[i], pat);
                }
            }
            return skip;
        }
        return this.length && pat && pat.length ? this.each(function () {
            innerHighlight(this, pat.toUpperCase());
        }) : this;
    };
    $.fn.removeHighlight = function () {
        return this.find("span.highlight").each(function () {
            this.parentNode.firstChild.nodeName;
            with (this.parentNode) {
                replaceChild(this.firstChild, this);
                normalize();
            }
        }).end();
    };

    function rafraichirLaureats() {
        var programme = $('#laureats #programmes option:selected').val();
        var annee = $('#laureats #annees option:selected').val();
        var new_param = "";
        if (programme == "") {
            $('#results-ajax .faq-bandeau').removeClass('cache');
        } else {
            new_param = "?programmes=" + programme;
            $('#results-ajax .faq-bandeau').each(function () {
                if ($(this).attr('id').includes(programme)) {
                    $(this).removeClass('cache');
                } else {
                    $(this).addClass('cache');
                }
            });
        }
        if (annee == "") {
            $('#results-ajax .content__section').removeClass('cache');
        } else {
            if (new_param == "") {
                new_param = "?annees=" + annee;
            } else {
                new_param += "&annees=" + annee;
            }
            $('#results-ajax .content__section .wrapp .accordeon-container > h2').each(
                function () {
                    var lang = "";
                    if ( $("html").attr("lang") != "fr-FR" ) {
                        lang = "-en";
                    }
                    if ( ( $(this).text() + lang) == annee) {
                        $(this).parent().parent().parent().removeClass("cache");
                    } else {
                        $(this).parent().parent().parent().addClass("cache");
                    }
                });
        }
        window.history.pushState("object or string", "Page Title 2", window.location.pathname + new_param);
        cleanUp();
        if ( annee != "" && programme != "" ) {
            setTimeout( function() {
                $( "#" + programme + "-" + annee ).find('.header').trigger("click");
            }, 2000);
        }
    }
    function cleanUp() {
        var programme = $('#laureats #programmes option:selected').val();
        $(".edition").each(function () {
            if ($(this).find('.cache').length == $(this).find('.result').length) {
                $(this).addClass('cache');
            } else {
                $(this).removeClass('cache');
            }
        });

        $(".faq-bandeau").each(function () {
            if ($(this).attr('id').includes(programme)) {
                if ($(this).find('.edition.cache').length == $(this).find('.edition').length) {
                    $(this).addClass('cache');
                } else {
                    $(this).removeClass('cache');
                }
            }
        });

        $('#results-ajax .content__section').each(function () {
            if ($(this).find('.faq-bandeau.cache').length == $(this).find('.faq-bandeau').length) {
                $(this).addClass("cache");
            }
        });
        if ($('#results-ajax').find('.content__section.cache').length == $('#results-ajax').find('.content__section').length) {
            $('.error_row.cache').removeClass('cache');
        } else {
            $('.error_row').addClass('cache');
        }
    }
    function getUrlVars() {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    function resetSearch() {
        $(".result").removeHighlight();
        $(".content__section, .content__section *").removeClass('cache');
        //$(".content__section *").removeClass('cache');
        $('#laureats select').val("");
        $('.result-name').val("");
        rafraichirLaureats();
    }
    $('#laureats select').on('change', function () {
        rafraichirLaureats();
    });
    $('.fa-search').on('click', function () {
        $('#search-form').trigger("submit");
    });
    $('#search-form').on('submit', function (e) {
        e.preventDefault();
        var mot = $('#search-form input').val();
        $(".result").removeHighlight();
        $(".result").removeClass('cache');
        if (mot != "") {
            $(".result").highlight(mot);
            $(".result").each(function () {
                if ($(this).find('.highlight')[0]) {
                    $(this).removeClass('cache');
                } else {
                    $(this).addClass('cache');
                }
            });
        } else {
            $('#laureats select').trigger('change');
        }
        cleanUp();
    });
    $('#reset-button').on('click', function () {
        resetSearch();
    });

    var an = getUrlVars()["annees"];
    var prog = getUrlVars()["programmes"];
    if (prog != "") {
        $('#programmes').val(prog).trigger('change');

    }
    if (an != undefined) {
        $('#annees').val(an).trigger('change');
    }
    if ((an != "" && an !== undefined) || (prog != "" && prog !== undefined)) {
        $('html, body').animate({
            scrollTop: $("#laureats").offset().top
        }, 100);
    }
});
