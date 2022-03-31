jQuery(document).ready(function ($) {
    function projectsAjax() {
        const projectContainer = $('#project-ajax-container');
        const button = $('.filter-button');
        const form = $('#search-form.projects');

        function initializeButton() {
            if (projectContainer.find('#reset-button').length) {
                projectContainer.find('#reset-button').click(function () {
                    const call = 'reset';
                    removeBox(call);
                });
            }
        }
        function removeBox(call, val) {
            const timeline = new TimelineLite({
                onStart: function () {
                    projectContainer.css('height', projectContainer.innerHeight());
                },
                onComplete: function () {
                    projectContainer.find('.item-ajax').remove();
                    if (call == 'byFilter') {
                        buttonCall(val);
                    }
                    if (call == 'byName') {
                        searchCall(val);
                    }
                    if (call == 'reset') {
                        resetCall();
                    }
                },
            });
            timeline
                .to(projectContainer, 0.3, { y: 25, opacity: 0 });
        }

        function buttonCall(term) {
            form.find('.project-name').val('');
            const data = {
                run: 'termclick',
                action: 'projectCall',
                posts: term
            };
            var realurl = '';
            $.ajax({ // you can also use $.post here
                url: projectInfo.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                success: function (data) {
                    if (data) {
                        projectInfo.current_page = 1;
                        $('.project-name').val('');
                        if (term != '') {
                            realurl = '?cat=' + term;
                            window.history.pushState('', '', realurl);
                        } if (term === '') {
                            window.history.replaceState({}, '', location.pathname);
                        }
                        const timeline = new TimelineLite({
                            onStart: function () {
                                projectContainer.append(data);
                                projectContainer.css('height', 'auto');
                            },
                        });

                        timeline
                            .to(projectContainer, 0.3, { y: 0, opacity: 1 });
                    }
                }
            });
        }

        function searchCall(val) {
            const data = {
                run: 'searchCall',
                action: 'projectCall',
                posts: val
            };
            var realurl = '';
            $.ajax({ // you can also use $.post here
                url: projectInfo.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                success: function (data) {
                    if (data) {
                        if (val != '') {
                            realurl = '?project-name=' + val;
                            window.history.pushState('', '', realurl);
                        } if (val === '') {
                            window.history.replaceState({}, '', location.pathname);
                        }
                        button.removeClass('active');
                        const timeline = new TimelineLite({
                            onStart: function () {
                                projectContainer.append(data);
                                projectContainer.css('height', 'auto');
                            },
                            onComplete: function () {
                                initializeButton();
                            },
                        });
                        timeline
                            .to(projectContainer, 0.3, { y: 0, opacity: 1 });
                    }
                }
            });
        }
        function resetCall() {
            button.removeClass('active');
            $('.filter-button.all').addClass('active');
            const data = {
                run: 'resetCall',
                action: 'projectCall',
                posts: projectInfo.post
            };
            var realurl = '';
            $.ajax({ // you can also use $.post here
                url: projectInfo.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                success: function (data) {
                    if (data) {
                        $('.project-name').val('');
                        window.history.replaceState({}, '', location.pathname);
                        const timeline = new TimelineLite({
                            onStart: function () {
                                projectContainer.append(data);
                                projectContainer.css('height', 'auto');
                            }
                        });

                        timeline
                            .to(projectContainer, 0.3, { y: 0, opacity: 1 });
                    }
                }
            });
        }

        function loadMore() {
            var filter = $('.filter-button.active');
            const data = {
                run: 'loadMore',
                action: 'projectCall',
                query: projectInfo.posts,
                page: projectInfo.current_page,
                cat: filter.attr('data-term')
            };

            $.ajax({ // you can also use $.post here
                url: projectInfo.ajaxurl, // AJAX handler
                data: data,
                type: 'POST',
                beforeSend: function (xhr) {
                    const timeline = new TimelineLite({
                        onComplete: function () {
                            $('#ajaxProjectsBtn').remove();
                        }
                    });

                    timeline
                        .to($('#ajaxProjectsBtn'), 0.3, { opacity: 0 });
                },
                success: function (data) {
                    if (data) {
                        projectInfo.current_page++;
                        projectContainer.append(data);
                        const timeline = new TimelineLite({
                            onComplete: function () {
                                projectContainer.find('.item-ajax.generated').removeClass('generated');
                                projectContainer.css('height', 'auto');
                            }
                        });

                        timeline
                            .fromTo(projectContainer.find('.item-ajax.generated'), 0.3, { y: 25, opacity: 0 }, { y: 0, opacity: 1 });
                    }
                },
                complete: function () {
                    if ($('#ajaxProjectsBtn').attr('data-page') == 1) {
                        $('#ajaxProjectsBtn').remove();
                    }
                }
            });
        }

        projectContainer.on('click', '#ajaxProjectsBtn', function () {
            loadMore();
        });

        button.each(function () {
            const self = $(this);
            const term = self.attr('data-term');
            self.click(function () {
                button.removeClass('active');
                self.addClass('active');
                const call = 'byFilter';
                removeBox(call, term);
            });
        });

        form.find('.custom-submit').click(function (e) {
            form.submit();
        });

        form.submit(function (e) {
            e.preventDefault();
            const searchVal = form.find('.project-name').val();
            const call = 'byName';
            removeBox(call, searchVal);
        });

        initializeButton();
    }
    if ($('.post-type-archive-projects').length) {
        projectsAjax();
    }
});
