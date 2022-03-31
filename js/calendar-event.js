jQuery(document).ready(function ($) {
    var lang = $('#calendar').attr('data-lang');
    var months = [];
    if (lang === 'fr') {
        months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    } else {
        months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    }

    var startYear = 2000;
    var endYear = 2020;
    var month = 0;
    var year = 0;
    var selectedDays = new Array();
    var selectedDay = '';

    var eventList = [];
    var events = $(this).find('.calendarEvents');
    var eventCategory = $('#form-event select').val();

    onPageLoad();

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

    function onPageLoad() {
        if ( $('#form-event select')[0] && window.location.hash) {
            const filter = $('#form-event select');
            eventCategory = location.hash.substr(1);
            filter.val(location.hash.substr(1)).trigger('change');
            $("#form-event .solo-select").addClass("active");
            setTimeout(function(){ 
                $("html, body").animate({
                    scrollTop: $(".filters-container").offset().top
                }, 10);
            }, 2000);
        }
    }

    $('.category-container').on('click', function () {
        event.preventDefault();

        var category = $(this).attr('data-category');
        var redirectUrl = $(this).attr('data-url');

        window.location.href = redirectUrl + '#' + category;
    });
var toto = 0;
    events.each(function () {
        toto++;
        initEvent($(this));
    });
    const container = $('.event-info-section');
    const filters = $('.archive-events select');
    function initResetButton() {
        var buttonReset = container.find('#reset-button');
        buttonReset.on('click', function () {
            removeBox();
            resetFilter();
        });
    }
    function resetFilter() {
        window.history.pushState("object or string", "Page Title 2", window.location.pathname );
        form.find('.event-name').val('');
        var ids = [];
        for (var i = 0; i < eventList.length; i++) {
            var event = eventList[i];
            if (event.dateTbd) {
                ids.push(event.id);
            } else if ((event.startDate.getMonth() === month && event.startDate.getFullYear() === year) ||
                (event.endDate.getMonth() === month && event.endDate.getFullYear() === year)) {
                ids.push(event.id);
            }
        }

        var data = {
            action: 'calendarEvents',
            eventIds: ids
        };
        $.ajax({ // you can also use $.post here
            url: cEvent.ajaxurl, // AJAX handler
            data: data,
            type: 'POST',
            success: function (data) {
                const timeline = new TimelineLite({
                    onStart: function () {
                        $('.event-info-section').html(data);
                        $('.event-info-section').css('height', 'auto');
                    },
                    onComplete: function () {
                        initResetButton();
                        lazyLoading();
                    }
                });
                timeline
                    .to(container, 0.3, { y: 0, opacity: 1 });
            }
        });
    }

    function removeBox() {
        filters.prop('selectedIndex', 0);
        const timeline = new TimelineLite({
            onStart: function () { container.css('height', container.innerHeight()); }
        });
        timeline
            .to(container, 0.3, { y: 25, opacity: 0 });
    }

    var date = new Date();
    var today = new Date();
    month = date.getMonth();
    year = date.getFullYear();
    showEventsByMonth();
    showTodaysEvent();
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

    function fadeOutCalendar() {
        var calendarContainer = $('.calendarDays');

        const timeline = new TimelineLite({
            onStart: function () {
                calendarContainer.css('height', 'auto');
            }
        });

        timeline.to(calendarContainer, 0.1, { opacity: 0 });
    }

    function fadeInCalendar() {
        var calendarContainer = $('.calendarDays');

        const timeline = new TimelineLite({
            onStart: function () {
                calendarContainer.css('height', 'auto');
            }
        });

        timeline.to(calendarContainer, 0.1, { opacity: 1 });
    }

    var next = $('#next-month');
    next.on('click', function () {
        fadeOutCalendar();
        var monthValue = document.getElementById('curMonth').innerText;
        var currentMonth = months.indexOf(monthValue.toString().substring(1));
        month = currentMonth + 1;
        if (month === 12) {
            month = 0;
            year++;
            document.getElementById('curYear').innerHTML = year;// `${year}`;
        }
        loadCalendarDays();
        document.getElementById('curMonth').innerHTML = "<span class='fa fa-caret-down fa-fw'></span> " + months[month];// ${months[month]}`;
        showEventsByMonth();
    });

    var prev = $('#prev-month');
    prev.on('click', function () {
        fadeOutCalendar();
        var monthValue = document.getElementById('curMonth').innerText;
        var currentMonth = months.indexOf(monthValue.toString().substring(1));
        month = currentMonth - 1;
        if (month === -1) {
            month = 11;
            year--;
            document.getElementById('curYear').innerHTML = year;// `${year}`;
        }
        loadCalendarDays();
        document.getElementById('curMonth').innerHTML = "<span class='fa fa-caret-down fa-fw'></span> " + months[month]; // ${months[month]}`;
        showEventsByMonth();
    });

    function loadCalendarMonths() {
        for (var i = 0; i < months.length; i++) {
            var doc = document.createElement('div');
            doc.innerHTML = months[i];
            doc.classList.add('dropdown-item');

            doc.onclick = (function () {
                var selectedMonth = i;
                return function () {
                    month = selectedMonth;
                    document.getElementById('curMonth').innerHTML = "<span class='fa fa-caret-down fa-fw'></span> " + months[month]; // ${months[month]}`;
                    loadCalendarDays();
                    return month;
                };
            })();

            document.getElementById('months').appendChild(doc);
        }
    }

    function loadCalendarYears() {
        document.getElementById('years').innerHTML = '';

        for (var i = startYear; i <= endYear; i++) {
            var doc = document.createElement('div');
            doc.innerHTML = i;
            doc.classList.add('dropdown-item');

            doc.onclick = (function () {
                var selectedYear = i;
                return function () {
                    year = selectedYear;
                    document.getElementById('curYear').innerHTML = year; // `${year}`;
                    $('.calendar-years').fadeOut('fast');
                    loadCalendarDays();
                    return year;
                };
            })();

            document.getElementById('years').appendChild(doc);
        }
    }

    function addEventToCalendarDay(d, event) {
        var dot = document.createElement('div');
        d.appendChild(dot);
        dot.classList.add('dot');
        eventIds.push(event.id);
    }
    var eventIds = [];

    function isEventEndMonthAfterEventStartMonth(startMonth, endMonth) {
        return (startMonth < endMonth)
    }
    function isDateDuringOrAfterStartDate(date, startDate) {
        return (date >= startDate)
    }

    function isMonthAfterStartEventMonth(month, startDate, year) {
        return (month > startDate.getMonth() && startDate.getFullYear() == year);
    }
    function isMonthBeforeEndEventMonth(month, endDate, year) {
        return (month < endDate.getMonth() && endDate.getFullYear() == year);
    }

    function isDateBeforeOrEqualEndDate(day, endDay) {
        return (day <= endDay);
    }

    function isMonthIsEventEndMonth(endDate, month, year) {
        return (endDate.getMonth() == month && endDate.getFullYear() == year);
    }

    function isMonthAfterStartMonth(month, startMonth) {
        return (month > startMonth);
    }

    function loadCalendarDays() {
        document.getElementById('calendarDays').innerHTML = '';

        var tmpDate = new Date(year, month, 0);
        var num = daysInMonth(month, year);
        var dayofweek = tmpDate.getDay(); // find where to start calendar day of week
        eventIds = [];
        for (var i = 0; i <= dayofweek; i++) {
            if (dayofweek !== 6) {
                var d = document.createElement('div');
                d.classList.add('day');
                d.classList.add('blank');
                d.innerHTML = 0;
                document.getElementById('calendarDays').appendChild(d);
            }
        }

        for (var i = 0; i < num; i++) {
            var tmp = i + 1;
            var d = document.createElement('div');
            d.id = 'calendarday_' + i;
            d.className = 'day';
            d.innerHTML = tmp;

            var dotsDiv = document.createElement('div');
            d.appendChild(dotsDiv);
            dotsDiv.classList.add('dots');

            // grey out dates before today.
            if (today.getFullYear() > year) {
                d.classList.add('past-day');
            }
            if (today.getFullYear() === year && today.getMonth() > month) {
                d.classList.add('past-day');
            }
            if (today.getFullYear() === year && today.getMonth() === month && today.getDate() > tmp) {
                d.classList.add('past-day');
            }

            for (var j = 0; j < eventList.length; j++) {
                var event = eventList[j];
                // intervalle de date dans meme mois
                if (event.endDate.getMonth() === month) {
                    if (event.startDate.getMonth() === month && event.startDate.getFullYear() === year) {
                        if (event.startDate.getDate() <= tmp && tmp <= event.endDate.getDate()) {
                            addEventToCalendarDay(dotsDiv, event);
                        }
                    }
                }

                // start date jusqua fin du mois
                if (event.endDate.getMonth() === month + 1 && event.startDate.getMonth() === month && event.startDate.getFullYear() === year) {
                    if (event.startDate.getDate() <= tmp) {
                        addEventToCalendarDay(dotsDiv, event);
                    }
                }

                // end date jusqau debut du mois
                if (event.startDate.getMonth() === month - 1 && event.endDate.getMonth() === month && event.startDate.getFullYear() === year) {
                    if (event.endDate.getDate() >= tmp) {
                        addEventToCalendarDay(dotsDiv, event);
                    }
                }
                // start date jusqua fin annee
                if (event.startDate.getMonth() > event.endDate.getMonth() && event.startDate.getMonth() === month && event.startDate.getFullYear() === year) {
                    if (event.startDate.getDate() <= tmp) {
                        addEventToCalendarDay(dotsDiv, event);
                    }
                }

                // end date jusqua debut annee
                if (event.startDate.getMonth() > event.endDate.getMonth() && event.endDate.getMonth() === month && event.endDate.getFullYear() === year) {
                    if (event.endDate.getDate() >= tmp) {
                        addEventToCalendarDay(dotsDiv, event);
                    }
                }
                if (isEventEndMonthAfterEventStartMonth(event.startDate.getMonth(), event.endDate.getMonth())
                    && isDateDuringOrAfterStartDate(tmp, event.startDate.getDate())
                    && (month == event.startDate.getMonth())
                    && event.endDate.getMonth() !== month + 1) {
                    addEventToCalendarDay(dotsDiv, event);
                }

                if (isMonthAfterStartEventMonth(month, event.startDate, year)
                    && isMonthBeforeEndEventMonth(month, event.endDate, year)) {
                    addEventToCalendarDay(dotsDiv, event);
                }

                if (isDateBeforeOrEqualEndDate(tmp, event.endDate.getDate())
                    && isMonthIsEventEndMonth(event.endDate, month, year)
                    && isMonthAfterStartMonth(month, event.startDate.getMonth())
                    && event.startDate.getMonth() !== month - 1) {
                    addEventToCalendarDay(dotsDiv, event);
                }
            }
            d.dataset.day = tmp;
            //d.dataset.eventids = eventIds;
          
            /* ****************** Single Day Event ********************** */

            d.addEventListener('click', function () {
                fadeOutSelectedDay();
                const _date = (month + 1) + '/' + this.dataset.day + '/' + year;

                if (selectedDay == _date) {
                    selectedDay = '';
                    this.classList.toggle('selected');
                } else {
                    selectedDay = _date;
                    var days = document.querySelectorAll('.day');
                    for (var i = 0; i < days.length; i++) {
                        days[i].classList.remove('selected');
                    }
                    this.classList.add('selected');
                }
                
                showTodaysEvent(this.dataset.day, month, year);
            });

            /* **************************************************** */

            document.getElementById('calendarDays').appendChild(d);
        }

        if (dayofweek < 4) {
            var lastDays = 35 - dayofweek - num - 2;
            for (var i = 0; i <= lastDays; i++) {
                var d = document.createElement('div');
                d.classList.add('day');
                d.classList.add('blank-white');
                d.innerHTML = 0;
                document.getElementById('calendarDays').appendChild(d);
            }
        }

        if (dayofweek == 4) {
            var lastDays = 40 - dayofweek - num;
            for (var i = 0; i <= lastDays; i++) {
                var d = document.createElement('div');
                d.classList.add('day');
                d.classList.add('blank-white');
                d.innerHTML = 0;
                document.getElementById('calendarDays').appendChild(d);
            }
        }
        if (dayofweek > 4) {
            var lastDays = 40 - dayofweek - num;
            for (var i = 0; i <= lastDays; i++) {
                var d = document.createElement('div');
                d.classList.add('day');
                d.classList.add('blank-white');
                d.innerHTML = 0;
                document.getElementById('calendarDays').appendChild(d);
            }
        }

        var clear = document.createElement('div');
        clear.className = 'clear';
        document.getElementById('calendarDays').appendChild(clear);
    }
    if ($('#form-event').length) {
        const filter = $('#form-event select');
        filter.change(function () {
            window.history.pushState('', '', ' ');
            eventCategory = $(this).val();
            filterEventByCategory(eventCategory);
            window.history.pushState("object or string", "Page Title 2", window.location.pathname + "#" + eventCategory );
        });
    }

    function fadeOutSelectedDay() {
        var selectedDateEvents = $('#daily-events');

        const timeline = new TimelineLite({
            onStart: function () {
                selectedDateEvents.css('height', 'auto');
            }
        });

        timeline.to(selectedDateEvents, 0.3, { opacity: 0 });
    }

    function fadeInSelectedDay() {
        var selectedDateEvents = $('#daily-events');

        const timeline = new TimelineLite({
            onStart: function () {
                selectedDateEvents.css('height', 'auto');
            }
        });

        timeline.to(selectedDateEvents, 0.3, { opacity: 1 });
    }

    function removeBox() {
        const timeline = new TimelineLite({
            onStart: function () { container.css('height', container.innerHeight()); }
        });
        timeline
            .to(container, 0.3, { y: 25, opacity: 0 });
    }
    function filterEventByCategory(val) {
        form.find('.event-name').val('');
        removeBox();
        var ids = [];
        var sortEventsByDate = eventList.sort(function (a, b) {
            var dateA = new Date(a.startDate); var dateB = new Date(b.startDate);
            return dateA - dateB;
        });

        var sortEventByTBD = sortEventsByDate.sort(function (a, b) {
            var titleA = a.dateTbd; var titleB = b.dateTbd;
            if (titleA < titleB) return -1;
            if (titleA > titleB) return 1;
            return 0;
        });
        for (var i = 0; i < sortEventByTBD.length; i++) {
            ids.push(sortEventByTBD[i].id);
        }

        var data = {
            action: 'calendarEvents',
            order: ids,
            cat: val
        };
        $.ajax({
            url: cEvent.ajaxurl,
            type: 'POST',
            data: data,
            success: function (data) {
                cEvent.current_page = 1;
                const timeline = new TimelineLite({
                    onStart: function () {
                        $('.event-info-section').html(data);
                        $('.event-info-section').css('height', 'auto');
                    },
                    onComplete: function () {
                        initResetButton();
                        lazyLoading();
                    }
                });
                timeline
                    .to(container, 0.3, { y: 0, opacity: 1 });
            }
        });
    }
    function isSelectedDayBeforeOrEqualEndDate(selectedDay, endDay) {
        return (selectedDay <= endDay);
    }
    function isSelectedMonthIsEventEndMonth(selectedDate, endMonth, year) {
        return (selectedDate.getMonth() == endMonth && selectedDate.getFullYear() == year);
    }
    function isStartMonthBeforeEndDateMonth(startMonth, endMonth) {
        return (startMonth < endMonth);
    }
    function isSelectedMonthAfterStartEventMonth(date, month, year) {
        return (date.getMonth() < month && date.getFullYear() === year);
    }
    function isSelectedMonthBeforeEndEventMonth(date, month, year) {
        return (date.getMonth() > month && date.getFullYear() === year);
    }
    function isStartDateThisMonthAndYear(date, month, year) {
        return (date.getMonth() === month && date.getFullYear() === year);
    }
    function isBetweenDays(start, end, day) {
        return start <= day && day <= end;
    }
    function endDateIsDifferentMonth(date, month) {
        return (date.getMonth() !== month);
    }
    function isStartDateLastMonth(date, month) {
        return (date.getMonth() === (month - 1));
    }
    function showTodaysEvent(selectedDay, selectedMonth, selectedYear) {
        var date;

        if (selectedDay) {
            date = new Date(selectedYear, selectedMonth, selectedDay);
        } else {
            date = new Date();
        }
        var month = date.getMonth();
        var year = date.getFullYear();
        var day = date.getDate();

        var ids = [];
        for (var i = 0; i < eventList.length; i++) {
            var event = eventList[i];
            if (isStartDateThisMonthAndYear(event.startDate, month, year) &&
                isBetweenDays(event.startDate.getDate(), event.endDate.getDate(), day)) {
                if (event.endDate.getMonth() === month && event.endDate.getFullYear() === year) {
                    ids.push(event.id);
                }
            }

            // in different month
            if (isStartDateThisMonthAndYear(event.startDate, month, year) && endDateIsDifferentMonth(event.endDate, month)) {
                if (event.startDate.getDate() <= day) {
                    ids.push(event.id);
                }
            }

            if (isStartDateLastMonth(event.startDate, month)) {
                if (event.endDate.getMonth() === month && event.endDate.getDate() >= day) {
                    ids.push(event.id);
                }
            }
            if (isSelectedMonthAfterStartEventMonth(event.startDate, month, year) && isSelectedMonthBeforeEndEventMonth(event.endDate, month, year)) {
                ids.push(event.id);
            }

            if (isStartMonthBeforeEndDateMonth(event.startDate.getMonth(), event.endDate.getMonth())
                && isSelectedMonthIsEventEndMonth(date, event.endDate.getMonth(), event.endDate.getFullYear())
                && isSelectedDayBeforeOrEqualEndDate(date.getDate(), event.endDate.getDate())) {
                ids.push(event.id);
            }
        }
        var data = {
            action: 'calendarEvents',
            eventIds: ids,
            dateTimestamp: date.getTime(),
            day: day,
            month: month,
            year: year,
            run: 'todayEvents'
        };
        $.ajax({
            url: cEvent.ajaxurl,
            type: 'POST',
            data: data,
            success: function (data) {
                //if (data.indexOf("event-illustration") == -1 && $(".event-info-section > .error_row.item-ajax")[0]) {
                if (data.indexOf("event-illustration") == -1 && location.hash.length == 0) {
                    var contenu = "<div class='small-event-border'><div class='selected-date'></div>";
                    contenu += "<div class='small-event-container'><div class='small-card-container'>";
                    contenu += "<a class='event-info-container-small'><div class='event-illustration small lozad not-hidden'></div></a>";
                    contenu += "<div class='event-informations-container small'><a class='event-info-container-small'>";
                    contenu += "<div class='event-categories small'><div class='event-category small filter-category'></div></div>";
                    contenu += "<div class='event-info-title small'></div>";
                    contenu += "<div class='same-day-dates date-small'></div>";
                    contenu += "<div class='event-info-location small'></div></a>";
                    contenu += "<a class='learn-more-small'></a></div></div></div></div>";
                    $('#daily-events').html(contenu);
                    setTimeout(function () {
                        if ($("html").attr("lang") == "fr-FR") {
                            $(".selected-date").html("Prochain événement");
                            $(".learn-more-small").html("En savoir plus");
                        } else {
                            $(".selected-date").html("Next event");
                            $(".learn-more-small").html("Learn more");
                        }
                        $(".learn-more-small").attr("href", $("a.event-info-container").attr('href'));
                        $(".small-card-container .event-info-container-small").attr("href", $("a.event-info-container").attr('href'));
                        $(".small-card-container .event-illustration").css("background-image", $(".event-info-container .event-illustration").css("background-image"));;
                        $(".event-category.small").html($(".wrapp .event-info-container").first().find(".event-category").html());
                        $(".event-info-title.small").html($(".wrapp .event-info-container").first().find(".event-info-title").html());
                        if ($(".wrapp .event-info-container").first().find(".plusieurs-dates").length) {
                            $(".same-day-dates").addClass("plusieurs-dates");
                        }
                        if ($(".wrapp .event-info-container").first().find(".same-day-dates").length) {
                            $(".date-small").html($(".wrapp .event-info-container").first().find(".same-day-dates").html());
                        } else {
                            $(".date-small").html($(".wrapp .event-info-container").first().find(".event-dates").html());
                            $(".date-small").addClass("event-dates");
                        }
                        $(".event-info-location.small").html($(".wrapp .event-info-container").first().find(".event-info-location").html());
                        if ($(".wrapp .event-info-container").first().find(".event-category.rouge").length) {
                            $(".event-categories.small").append( $(".wrapp .event-info-container").first().find(".event-category.rouge").get(0).outerHTML);
                            $(".event-categories.small .event-category.rouge").addClass( "small" );
                        }

                    }, 800);
                } else {
                    $('#daily-events').html(data);
                }
            },
            complete: function () {
                fadeInSelectedDay();
                lazyLoading();
            }
        });
    }
    function plusieursDates() {
        var tempArray = [];
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        if( $(".plusieurs")[0] ) {
            $(".plusieurs").each( function(){
                if( ! tempArray.includes($(this).attr("data-event-id")) ) {
                    tempArray.push( $(this).attr("data-event-id") );
                }
            });
            $.each(tempArray, function(index, value) {
                $(".event-informations-container").each( function() {
                    var conteneurCal = $(this);
                    if( value == conteneurCal.attr("data-id")) {
                        conteneurCal.find(".date-small > div").remove();
                        $(".plusieurs[data-event-id]").each( function(){ 
                            if( value == $(this).attr("data-event-id")) {
                                var dateTemp = new Date( $(this).attr("data-event-start") );
                                conteneurCal.find(".date-small").append( dateTemp.toLocaleDateString('fr-FR', options) + "<br>" );
                            }
                        });
                    }
                });
            });
        }
    }
    function showEventsByMonth() {
        removeBox();
        var ids = [];
        var tempArray = [];
        for (var i = 0; i < eventList.length; i++) {
            var event = eventList[i];
            if (isNaN(event.startDate)) {
                tempArray.unshift(event);
            } else {
                tempArray.push(event);
            }
        }

        var sortEventsByDate = tempArray.sort(function (a, b) {
            if (isNaN(a.startDate)) {
                return -1;
            }
            if (isNaN(b.startDate)) {
                return -1;
            }

            var dateA = new Date(a.startDate); 
            var dateB = new Date(b.startDate);
            return dateA - dateB;
        });

        var sortEventByTBD = sortEventsByDate.sort(function (a, b) {
            var titleA = a.dateTbd; var titleB = b.dateTbd;
            if (titleA < titleB) return -1;
            if (titleA > titleB) return 1;
            return 0;
        });

        for (var j = 0; j < sortEventByTBD.length; j++) {
            ids.push(sortEventByTBD[j].id);
        }

        var data = {
            action: 'calendarEvents',
            cat: eventCategory,
            order: ids
        };
        $.ajax({
            url: cEvent.ajaxurl,
            type: 'POST',
            data: data,
            success: function (data) {
                const timeline = new TimelineLite({
                    onStart: function () {
                        $('.event-info-section').html(data);
                        $('.event-info-section').css('height', 'auto');
                    },
                    onComplete: function () {
                        initResetButton();
                        fadeInCalendar();
                        lazyLoading();
                    }
                });
                timeline
                    .to(container, 0.3, { y: 0, opacity: 1 });
            }
        });
    }
    function showEventsByDate(eventIds) {
        removeBox();
        var ids = eventIds.split(',');
        var data = {
            action: 'calendarEvents',
            eventIds: ids,
            cat: eventCategory
        };
        $.ajax({
            url: cEvent.ajaxurl,
            type: 'POST',
            data: data,
            success: function (data) {
                const timeline = new TimelineLite({
                    onStart: function () {
                        $('.event-info-section').html(data);
                        $('.event-info-section').css('height', 'auto');
                    },
                    onComplete: function () {
                        initResetButton();
                        lazyLoading();
                    }
                });
                timeline
                    .to(container, 0.3, { y: 0, opacity: 1 });
            }
        });
    }
    function daysInMonth(month, year) {
        var d = new Date(year, month + 1, 0);
        return d.getDate();
    }

    function setDate(dt) {
        // convert the date to js object
        // parse and check if on current month, otherwise ignore
        const d = new Date(dt);

        if (d.getMonth() != NaN) {
            if (month == d.getMonth()) {
                const _date = (month + 1) + '/' + d.getDate() + '/' + year;

                var day = d.getDate() - 1;
                selectedDay = _date;
                var days = document.querySelectorAll('.day');

                for (var i = 0; i < days.length; i++) {
                    days[i].classList.remove('selected');
                }
                document.getElementById('calendarday_' + day).classList.add('selected');
            }
        }
    }

    const form = $('#search-form.events');
    form.find('.custom-submit').click(function (e) {
        form.submit();
    });

    form.submit(function (e) {
        e.preventDefault();
        const searchVal = form.find('.event-name').val();
        removeBoxThenAction('searchEventByName', searchVal);
    });

    function removeBox() {
        const timeline = new TimelineLite({
            onStart: function () { container.css('height', container.innerHeight()); }
        });
        timeline
            .to(container, 0.3, { y: 25, opacity: 0 });
    }

    function removeBoxThenAction(action, value) {
        filters.prop('selectedIndex', 0);
        const timeline = new TimelineLite({
            onStart: function () { container.css('height', container.innerHeight()); },
            onComplete: function () {
                if (action == 'searchEventByName') {
                    filterBySearchName(value);
                }
            }
        });
        timeline
            .to(container, 0.3, { y: 25, opacity: 0 });
    }

    function filterBySearchName(searchVal) {
        var ids = [];
        var sortEventsByDate = eventList.sort(function (a, b) {
            var dateA = new Date(a.startDate); var dateB = new Date(b.startDate);
            return dateA - dateB;
        });

        var sortEventByTBD = sortEventsByDate.sort(function (a, b) {
            var titleA = a.dateTbd; var titleB = b.dateTbd;
            if (titleA < titleB) return -1;
            if (titleA > titleB) return 1;
            return 0;
        });
        for (var i = 0; i < sortEventByTBD.length; i++) {
            ids.push(sortEventByTBD[i].id);
        }

        filters.prop('selectedIndex', 0);
        const data = {
            run: 'search',
            action: 'calendarEvents',
            searchValue: searchVal,
            order: ids
        };
        var realurl = '';
        $.ajax({ // you can also use $.post here
            url: cEvent.ajaxurl, // AJAX handler
            data: data,
            type: 'POST',
            success: function (data) {
                if (data) {
                    if (searchVal != '') {
                        realurl = '?event-name=' + searchVal;
                        window.history.pushState('', '', realurl);
                    } if (searchVal === '') {
                        window.history.replaceState({}, '', location.pathname);
                    }
                    const timeline = new TimelineLite({
                        onStart: function () {
                            $('.event-info-section').html(data);
                            $('.event-info-section').css('height', 'auto');
                        },
                        onComplete: function () {
                            initResetButton();
                            lazyLoading();
                        }
                    });
                    timeline
                        .to(container, 0.3, { y: 0, opacity: 1 });
                }
            }
        });
    }
    $('.event-info-section').on('click', '.filter-category', function () {
        event.preventDefault();
        var category = $(this).attr('data-category');
        const filter = $('#form-event select');
        eventCategory = category;
        filter.val(category).trigger('change');
    });

    $('.event-categories').on('click', '.event-category.small.filter-category', function () {
        event.preventDefault();
        var category = $(this).attr('data-category');
        const filter = $('#form-event select');
        eventCategory = category;
        filter.val(category).trigger('change');
    });
    function loadMore() {
        var ids = [];
        var tempArray = [];
        var dates = [];

        for (var i = 0; i < eventList.length; i++) {
            var event = eventList[i];
            if (isNaN(event.startDate)) {
                tempArray.unshift(event);
            } else {
                tempArray.push(event);
            }
        }
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
        for (var j = 0; j < sortEventByTBD.length; j++) {
            var sortedEvent = sortEventByTBD[j];

            ids.push(sortedEvent.id);
            dates.push(sortedEvent.startDate);
        }

        const filter = $('#form-event select');

        const data = {
            action: 'calendarEvents',
            posts: $('#ajaxEventBtn').attr('data-query'),
            query: cEvent.posts,
            page: cEvent.current_page,
            cat: filter.val(),
            order: ids,
            dates: dates
        };

        $.ajax({ // you can also use $.post here
            url: cEvent.ajaxurl, // AJAX handler
            data: data,
            type: 'POST',
            beforeSend: function (xhr) {
                const timeline = new TimelineLite({
                    onComplete: function () {
                        $('#ajaxEventBtn').remove();
                    }
                });

                timeline
                    .to($('#ajaxEventBtn'), 0.3, { opacity: 0 });
            },
            success: function (data) {
                if (data) {
                    cEvent.current_page++;
                    container.append(data);
                    const timeline = new TimelineLite({
                        onComplete: function () {
                            container.find('.item-ajax.generated').removeClass('generated');
                            container.css('height', 'auto');
                            lazyLoading();
                        }
                    });

                    timeline
                        .fromTo(container.find('.item-ajax.generated'), 0.3, { y: 25, opacity: 0 }, { y: 0, opacity: 1 });
                }
            },
            complete: function () {
                if ($('#ajaxEventBtn').attr('data-page') == 1) {
                    $('#ajaxEventBtn').remove();
                }
            }
        });
    }

    container.on('click', '#ajaxEventBtn', function () {
        loadMore();
    });

    if ($('#calendar').length) {
        window.addEventListener('load', function () {
            var date = new Date();
            month = date.getMonth();
            year = date.getFullYear();
            document.getElementById('curMonth').innerHTML = "<span class='fa fa-caret-down fa-fw'></span> " + months[month]; // ${months[month]}`;
            document.getElementById('curYear').innerHTML = year; // `${year}`;
            loadCalendarMonths();
            loadCalendarYears();
            loadCalendarDays();
            
            var url = new URL(window.location.href);
            var eventName = url.searchParams.get('event-name');
            if (eventName !== null && eventName !== '') {
                $(".post-type-archive .filters-container input.event-name").val(eventName);
                filterBySearchName(eventName);
            }
        });
    }

});
