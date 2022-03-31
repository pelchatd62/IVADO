jQuery(document).ready(function($) {
  // disapble and enable scroll
  // $.fn.disableScroll = function() {
  //   window.oldScrollPos = $(window).scrollTop();
  //   $(window).on('scroll.scrolldisabler', function (event) {
  //     $(window).scrollTop(window.oldScrollPos);
  //     event.preventDefault();
  //   });
  // };
  var windowTop = 0;
  var offsetContainerList = 0;
  function disableScroll(){
    // var offsetScrollList = $('.edge-ils-item-link:first').offset().top; 

      if ($('html').hasClass('scroll-lock')) {
                    $('html').removeClass('scroll-lock');  
                    // $('.edge-ils-content-table').css('top', eval(offsetContainerList)-40+'px'); //change image container top position
                    $('html').scrollTop(windowTop); //scroll to original position
      }
      else {                
          windowTop = $(window).scrollTop();
          // offsetContainerList = $('.edge-ils-content-table').offset().top;  
          $('html').addClass('scroll-lock');      
          // $('.edge-ils-content-table').css('top', -offsetScrollList + 'px'); //change image container top position
      }    
  }
  $.fn.enableScroll = function() {
    $(window).off('scroll.scrolldisabler');
  };
  function researcherInfo(idSearcher,typeNeed) {
    const data = {
      run: 'searcherinfo',
      action: 'personInfoPopUp',
      posts: idSearcher,
      type: typeNeed
    };
		 const infoBox = $('#person-info-box');
		 const closeBox = new TimelineLite({ paused: true, onComplete: function() { infoBox.css('display', 'none'); } });
		 const openBox = new TimelineLite();
    function showPopUp() {
      infoBox.toggle();
      openBox.fromTo(infoBox, 0.3, { opacity: 0 }, { opacity: 1 }, 0);
    }
    function closePopUp() {
      const closingCross = infoBox.find('.croix');
      let closingArea = infoBox.find('.close-area');
      closeBox.fromTo(infoBox, 0.4, { opacity: 1 }, { opacity: 0 }, 0);
      closingCross.add(closingArea).click(function() {
        disableScroll();
        closeBox.play();
      });
    }
    $.ajax({
      url: personInfo.ajaxurl,
      data: data,
      type: 'POST',
      success: function(data) {
        if (data) {
          infoBox.html(data);
          showPopUp();
          disableScroll();
          closePopUp();
        }
      }
    });
  }
  if ($('.ajax-researcher').length) {
    $('.info-pop-up').each(function() {
      const self = $(this);
			 const button = self.find('.ajax-researcher');
			 const researcherId = button.attr('data-id-researcher');
			 const type = button.attr('data-type');
      button.each(function() {
        $(this).click(function() {
          researcherInfo(researcherId, type);
        });
      });
    });
  }
});
