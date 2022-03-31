jQuery(document).ready(function ($) {
    var itemContainer = $('#container-items-to-be-loaded-in');
    var loadMoreBtn = $('#load-more-btn');
    var hiddenQuery = $('#hiddenQuery');
    var postIds = hiddenQuery.attr('data-ids');
    var postCount = hiddenQuery.attr('data-count');
    var cardPath = loadMoreBtn.attr('data-path');
    var loadMoreBtnContainer = $('#loadmore');
    var finishedTime = new TimelineLite({ paused: true, onComplete: function () { loadMoreBtnContainer.hide(); } });
    finishedTime.fromTo(loadMoreBtnContainer, 0.15, { opacity: 1, height: 'auto' }, { opacity: 0, height: 0 });

    function setHiddenQuery() {
        hiddenQuery = $('#hiddenQuery');
        postIds = hiddenQuery.attr('data-ids');
        postCount = hiddenQuery.attr('data-count');
    }

    function reset(finishedTime, generatedPosts, generatedCount) {
        postCount -= generatedCount;
        generatedPosts.removeClass('generated');
        if (postCount <= 0) {
            finishedTime.play();
        }
    }

    if (postCount > 0) {
        loadMoreBtn.click(function () {
            setHiddenQuery();
            var data = {
                action: 'onlineFormationsCall',
                path: cardPath,
                postIds: postIds
            };
            $.ajax({
                url: onlineFormationsInfo.ajaxurl,
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    hiddenQuery.remove();
                },
                success: function (data) {
                    if (data) {
                        itemContainer.append(data);
                        var generatedPosts = itemContainer.find('.generated');
                        var showTimeline = new TimelineLite({ onComplete: function () { reset(finishedTime, generatedPosts, generatedPosts.length); } });
                        showTimeline.to(generatedPosts, 0.6, { y: 0, opacity: 1 });
                    }
                }
            });
        });
    }
});
