jQuery(document).ready(function ($) {
    var itemContainer = $('#container-items-to-be-loaded-in');
    var loadMoreBtn = $('#load-more-btn-news');
    var hiddenQuery = $('#hiddenQuery');
    var postIds = hiddenQuery.attr('data-ids');
    var postCount = hiddenQuery.attr('data-count');
    var cardPath = loadMoreBtn.attr('data-path');
    var loadMoreBtnContainer = $('#loadmore');

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

    function hoverBlogCard() {
        let blogCard = $('.solo-event-article.blog');
        blogCard.each(function () {
            let self = $(this);
            let image = self.find('.image');
            let title = self.find('h3');
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

    function setHiddenQuery() {
        hiddenQuery = $('#hiddenQuery');
        postIds = hiddenQuery.attr('data-ids');
        postCount = hiddenQuery.attr('data-count');
    }

    function reset(generatedPosts, generatedCount) {
        postCount -= generatedCount;
        generatedPosts.removeClass('generated');
        if (postCount <= 0) {
            loadMoreBtnContainer.addClass('hidden');
        }
    }

    if (postCount > 0) {
        loadMoreBtn.click(function () {
            setHiddenQuery();
            var data = {
                run: 'loadmore',
                action: 'articleChoiceCategroy',
                path: cardPath,
                postIds: postIds,
            };
            $.ajax({
                url: articleChoice.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    hiddenQuery.remove();
                },
                success: function (data) {
                    if (data) {
                        itemContainer.append(data);
                        var generatedPosts = itemContainer.find('.generated');
                        var showTimeline = new TimelineLite({
                            onComplete: function () {
                                reset(generatedPosts, generatedPosts.length);
                                hoverBlogCard();
                                lazyLoading();
                            },
                        });
                        showTimeline.to(generatedPosts, 0.6, { y: 0, opacity: 1 });
                    }
                },
            });
        });
    }

    const filter = $('#form-article select');
    filter.change(function () {
        $('#container-items-to-be-loaded-in').html('');
        $('#loadmore').addClass('hidden');
        event.preventDefault();
        var categoryToBeFiltered = $(this).val();
        var typeItems = "post";
        const data = {
            run: 'articleFilter',
            action: 'articleChoiceCategroy',
            category: categoryToBeFiltered,
            typeItems: typeItems,
        };
        $.ajax({
            url: articleChoice.ajaxurl,
            type: 'POST',
            data: data,
            success: function (data) {
                if (data) {
                    var realurl = '';
                    if (categoryToBeFiltered != '') {
                        realurl = '?categorie=' + categoryToBeFiltered;
                        window.history.pushState('', '', realurl);
                    } if (categoryToBeFiltered === '') {
                        window.history.replaceState({}, '', location.pathname);
                    }
                    itemContainer.html(data);
                    hoverBlogCard();
                    var dataCount = $('#hiddenQuery').attr('data-count');
                    if (parseInt(dataCount) >= 0) {
                        $('#loadmore').removeClass('hidden');
                    }
                    lazyLoading();
                }
            },
        });
    });
});
