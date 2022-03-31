jQuery(document).ready(function ($) {
  function partnerAjax() {
    const container = $('#partner-ajax');
    const filters = $('#partner-form select');
    let form = $('#search-form.membre-industriel');

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

    function initializeButton() {
      var buttonReset = container.find('#reset-button:not(.membre-industriel)'),
        buttonResetIndustriel = container.find('#reset-button.membre-industriel');
      buttonReset.on('click', function () {
        let call = 'resetPartners';
        removeBox(call);
      });
      buttonResetIndustriel.on('click', function () {
        let call = 'resetPartnersIndustriel';
        removeBox(call);
      });
    }

    function removeBox(call, val) {
      const timeline = new TimelineLite({
        onStart: function () {
          container.css('height', container.innerHeight());
        },
        onComplete: function () {
          container.find('.item-ajax').remove();
          if (call == 'filter') {
            partnerFilter();
          }
          if (call == 'byName') {
            searchCall(val);
          }
          if (call == 'resetPartners') {
            resetCall();
          }
          if (call == 'resetPartnersIndustriel') {
            resetCallIndustriel();
          }
        },
      });
      timeline.to(container, 0.3, { y: 25, opacity: 0 });
    }

    function partnerFilter() {
      const data = {
        run: 'partnerFilter',
        action: 'partnerCall',
        posts: partnerInfo.posts,
        pageMembers: false,
        selects: {},
      };
      if ($('body.page-template-tpl-membres-industriels').length) {
        data['pageMembers'] = true;
      }
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
        url: partnerInfo.ajaxurl,
        data: data,
        type: 'POST',
        beforeSend: function (xhr) {
          initializeButton();
        },
        success: function (data) {
          if (data) {
            window.history.pushState('', '', '?' + realurl);
            const timeline = new TimelineLite({
              onStart: function () {
                container.append(data);
                container.css('height', 'auto');
              },
              onComplete: function () {
                initializeButton();
                lazyLoading();
              },
            });
            timeline.to(container, 0.3, { y: 0, opacity: 1 });
          }
        },
      });
    }
    function resetCall() {
      filters.prop('selectedIndex', 0);
      const data = {
        run: 'resetCall',
        action: 'partnerCall',
        posts: partnerInfo.post,
      };
      $.ajax({
        // you can also use $.post here
        url: partnerInfo.ajaxurl, // AJAX handler
        data: data,
        type: 'POST',
        success: function (data) {
          if (data) {
            window.history.replaceState({}, '', location.pathname);
            const timeline = new TimelineLite({
              onStart: function () {
                container.append(data);
                container.css('height', 'auto');
              },
              onComplete: function () {
                lazyLoading();
              },
            });
            timeline.to(container, 0.3, { y: 0, opacity: 1 });
          }
        },
      });
    }

    function resetCallIndustriel() {
      filters.prop('selectedIndex', 0);
      const data = {
        run: 'resetCallIndustriel',
        action: 'partnerCall',
        posts: partnerInfo.post,
      };
      $.ajax({
        // you can also use $.post here
        url: partnerInfo.ajaxurl, // AJAX handler
        data: data,
        type: 'POST',
        success: function (data) {
          if (data) {
            window.history.replaceState({}, '', location.pathname);
            const timeline = new TimelineLite({
              onStart: function () {
                container.append(data);
                container.css('height', 'auto');
              },
              onComplete: function () {
                lazyLoading();
              },
            });

            timeline.to(container, 0.3, { y: 0, opacity: 1 });
          }
        },
      });
    }

    function searchCall(val) {
      filters.prop('selectedIndex', 0);
      let data = {
        run: 'searchCall',
        action: 'partnerCall',
        posts: val,
      };
      var realurl = '';
      $.ajax({
        // you can also use $.post here
        url: partnerInfo.ajaxurl, // AJAX handler
        data: data,
        type: 'POST',
        success: function (data) {
          if (data) {
            if (val != '') {
              realurl = '?partner-name=' + val;
              window.history.pushState('', '', realurl);
            }
            if (val === '') {
              window.history.replaceState({}, '', location.pathname);
            }
            let timeline = new TimelineLite({
              onStart: function () {
                container.append(data);
                container.css('height', 'auto');
              },
              onComplete: function () {
                initializeButton();
                lazyLoading();
              },
            });

            timeline.to(container, 0.3, { y: 0, opacity: 1 });
          }
        },
      });
    }

    filters.change(function () {
      let call = 'filter';
      removeBox(call);
      // partnerFilter();
    });

    form.find('.custom-submit').click(function (e) {
      form.submit();
    });

    form.submit(function (e) {
      e.preventDefault();
      let searchVal = form.find('.partner-name').val();
      let call = 'byName';
      removeBox(call, searchVal);
    });
  }
  if ($('.partner-form').length) {
    partnerAjax();
  }
});
