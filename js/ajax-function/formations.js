jQuery(document).ready(function ($) {
    const container = $('.formation-section');
    const filters = $('#form-event-id select');

    function lazyLoading() {
        const offsetAppear = $(window).height();
        const durationAppear = 1000;
        if ($('.lozad').length) {
            var productObserver = lozad('.lozad', {
                rootMargin: offsetAppear + 'px 0px',
                loaded: function (el) {
                    $(el).on('load', function () {
                        const item = $(this);
                        TweenLite.fromTo(item, durationAppear * 0.001, { opacity: 0, visibility: 'hidden' }, { ease: Power4.easeOut, opacity: 1, visibility: 'visible' });
                    });
                }
            });
            productObserver.observe();
        }
    }

    function removeBox() {
        const timeline = new TimelineLite({
            onStart: function () {
                container.css('height', container.innerHeight());
            },
            onComplete: function () {
                container.find('.item-ajax').remove();
            },
        });
        timeline
            .to(container, 0.3, { y: 25, opacity: 0 });
    }

    function formationFilter(formationCategory) {
        var ids = [];
        var tempArray = [];
        var dates = [];
        var sortEventTBD = eventList.forEach(event => {
             if (isNaN(event.startDate)) {
                tempArray.unshift(event);
            } else {
                tempArray.push(event);
            }
         });
        var sortEventsByDate = tempArray.sort(function (a, b) {
            if (isNaN(a.startDate)) {
                return -1;
            }
            if (isNaN(b.startDate)) {
                return -1;
            }

            var dateA = new Date(a.startDate); var dateB = new Date(b.startDate);
            return dateA - dateB;
        });

        var sortEventByTBD = sortEventsByDate.sort(function (a, b) {
            var titleA = a.dateTbd; var titleB = b.dateTbd;
            if (titleA < titleB) return -1;
            if (titleA > titleB) return 1;
            return 0;
        });
        sortEventByTBD.forEach(function (event) {
            ids.push(event.id);
            dates.push(event.startDate);
        });

        const data = {
            action: 'formationsFilterCall',
            subCat: formationCategory,
            order: ids,
            dates: dates
        };
        $.ajax({
            url: formationsInfo.ajaxurl,
            type: 'POST',
            data: data,
            beforeSend: removeBox(),
            success: function (data) {
                if (data) {
                    const timeline = new TimelineLite({
                        onStart: function () {
                            container.html(data);
                            container.css('height', 'auto');
                        },
                        onComplete: function () {
                            initResetButton();
                            lazyLoading();
                        },
                    });

                    timeline
                        .to(container, 0.3, { y: 0, opacity: 1 });
                }
            }
        });
    }

    var eventList = [];
    var events = $(this).find('.formation-section-data');
    events.each(function () {
        initEvent($(this));
    });
    function initEvent($event) {
        var startDate = new Date($event.attr('data-event-start').replace(' ', 'T'));
        var endDate = new Date($event.attr('data-event-end').replace(' ', 'T'));
        var dateTbd = $event.attr('data-event-tbd');
        var event = {
            id: $event.attr('data-event-id'),
            startDate: startDate,
            endDate: endDate,
            dateTbd: dateTbd
        };
        eventList.push(event);
    }

    function loadMore() {
        $('#ajaxFormationBtn').remove();
        var ids = [];
        var tempArray = [];
        var dates = [];
        // var sortEventTBD = eventList.forEach(event => {
        //     if (isNaN(event.startDate)) {
        //         tempArray.unshift(event);
        //     } else {
        //         tempArray.push(event);
        //     }
        // });
        var sortEventsByDate = tempArray.sort(function (a, b) {
            if (isNaN(a.startDate)) {
                return -1;
            }
            if (isNaN(b.startDate)) {
                return -1;
            }

            var dateA = new Date(a.startDate); var dateB = new Date(b.startDate);
            return dateA - dateB;
        });

        var sortEventByTBD = sortEventsByDate.sort(function (a, b) {
            var titleA = a.dateTbd; var titleB = b.dateTbd;
            if (titleA < titleB) return -1;
            if (titleA > titleB) return 1;
            return 0;
        });
        sortEventByTBD.forEach(function (event) {
            ids.push(event.id);
            dates.push(event.startDate);
        });

        var formationCategory = $('#form-event-id select').val();
        const data = {
            action: 'formationsCall',
            cat: formationCategory,
            posts: $('#ajaxFormationBtn').attr('data-query'),
            page: formationsInfo.current_page,
            query: formationsInfo.posts,
            order: ids,
            dates: dates
        };

        $.ajax({ // you can also use $.post here
            url: formationsInfo.ajaxurl, // AJAX handler
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                const timeline = new TimelineLite({
                    onComplete: function () {
                        $('#ajaxFormationBtn').remove();
                        $('formation-load-more').remove();
                    }
                });

                timeline
                    .to($('#ajaxFormationBtn'), 0.3, { opacity: 0 });
            },
            success: function (data) {
                if (data) {
                    formationsInfo.current_page++;
                    container.append(data);
                    const timeline = new TimelineLite({
                        onComplete: function () {
                            container.find('.item-ajax.generated').removeClass('generated');
                            lazyLoading();
                        }
                    });

                    timeline
                        .fromTo(container.find('.item-ajax.generated'), 0.3, { y: 25, opacity: 0 }, { y: 0, opacity: 1 });
                }
            },
            complete: function () {
                if ($('#ajaxFormationBtn').attr('data-page') == 1) {
                    $('#ajaxFormationBtn').remove();
                }
            }
        });
    }

    filters.change(function () {
        var formationCategory = $('#form-event-id select').val();
        formationFilter(formationCategory);
    });
    function initResetButton() {
        var buttonReset = $('.formation-section').find('#reset-button');
        buttonReset.on('click', function () {
            removeBox();
            resetFilter();
        });
    }
    function resetFilter() {
        $('#form-event-id select').val('');
        formationFilter('');
    }
    onload();

    function onload() {
        var ids = [];
        var tempArray = [];
        var dates = [];
        var sortEventTBD = eventList.forEach(event => {
            if (isNaN(event.startDate)) {
                tempArray.unshift(event);
            } else {
                tempArray.push(event);
            }
        });
        var sortEventsByDate = tempArray.sort(function (a, b) {
            if (isNaN(a.startDate)) {
                return -1;
            }
            if (isNaN(b.startDate)) {
                return -1;
            }

            var dateA = new Date(a.startDate); var dateB = new Date(b.startDate);
            return dateA - dateB;
        });

        var sortEventByTBD = sortEventsByDate.sort(function (a, b) {
            var titleA = a.dateTbd; var titleB = b.dateTbd;
            if (titleA < titleB) return -1;
            if (titleA > titleB) return 1;
            return 0;
        });
        sortEventsByDate.forEach(function (event) {
            ids.push(event.id);
            dates.push(event.startDate);
        });

        const data = {
            run: 'init',
            action: 'formationsCall',
            order: ids,
            dates: dates
        };
        $.ajax({
            url: formationsInfo.ajaxurl,
            type: 'POST',
            data: data,
            beforeSend: removeBox(),
            success: function (data) {
                if (data) {
                    const timeline = new TimelineLite({
                        onStart: function () {
                            container.html(data);
                            container.css('height', 'auto');
                        },
                        onComplete: function () {
                            initResetButton();
                            lazyLoading();
                        },
                    });

                    timeline
                        .to(container, 0.3, { y: 0, opacity: 1 });
                }
            }
        });
    }
    container.on('click', '#ajaxFormationBtn', function () {
        loadMore();
    });
});
