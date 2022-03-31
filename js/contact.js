jQuery(document).ready(function ($) {

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
    var scrollVariable = true;
    function addListenerToFormButtons($el) {
        var buttons = $el.find('.form-button');
        var closeButton = document.getElementById('close-form-button');
        closeButton.addEventListener('click', function () {
            window.history.replaceState({}, '', location.pathname);
            hideForm();
        });
        buttons.each(function () {
            let self = $(this);
            let button = $(this);
            let id = self.attr('data-id');
            let name = self.attr('data-name');
            // let name = encodeURI(self.attr('data-name'));
            self.click(function () {
                window.history.pushState('', '', '#' + name);
                bodyScroll(false);
                showForm(id);
            });
        });
    }
    function hideForm() {
        document.getElementById('forms-container').style.display = 'none';
        for (var i = 1; i < 9; i++) {
            var form = document.getElementById('form_' + i);
            form.style.display = 'none';
        }
        bodyScroll(true);
    }
    function showForm(id) {
        document.getElementById('forms-container').style.display = 'block';
        var form = document.getElementById('form_' + id);
        form.style.display = 'block';
    }

    function errorForm() {
        //let $formSecion = $('.ivado-form').find('.validation_error').parent().parent().parent().parent()
        //    , $container = $('#forms-container');
        //$formSecion.add($container).show();
        setTimeout(function(){
            $('.validation_error').parent().parent().parent().show();
            $('#forms-container').css( "display" , "block" );
        }, 500);
        bodyScroll(false);
    }
    function confirmationForm() {
        let $formSecion = $('.ivado-form').find('.gform_confirmation_wrapper ').parent().parent()
            , $container = $('#forms-container');
        $formSecion.add($container).show();
        bodyScroll(false);
    }
    function condition() {
        let form = $('.ivado-form');
        form.each(function () {
            let self = $(this);
            let checkBox = self.find('.condition input');
            let formWrapper = self.find('.form-wrapper');
            checkBox.change(function () {
                formWrapper.toggleClass("hide");
            });
        });
    }

    function addNormalClass() {
        let gfield = $('#forms-container .gfield');
        gfield.each(function () {
            let self = $(this);
            let radio = self.find('.ginput_container_radio');
            let checkbox = self.find('.ginput_container_checkbox');
            let time = self.find('.ginput_container_time');
            let select = self.find('.ginput_container_select');
            let muiltiSelect = self.find('.ginput_container_multiselect');
            let placeHolder = self.find('input').attr("placeholder");
            if (radio.length || checkbox.length || time.length || select.length || muiltiSelect.length || typeof placeHolder !== "undefined") {
                // if(radio.length || checkbox.length || time.length || select.length || muiltiSelect.length){
                self.addClass('normal');
            }
        });
    }

    function correctBigLabel() {
        setInterval(function () {
            let gfield = $('#forms-container .gfield');
            gfield.each(function () {
                let self = $(this);
                let txtArea = self.find('textarea');
                let label = self.find('.gfield_label');
                let txtAreaSize = txtArea.width();
                let labelSize = label.width();
                if (self.find('textarea').length) {
                    if (labelSize > txtAreaSize - 50) {
                        self.addClass('normal');
                    }
                }
                self.find('textarea').click(function () {
                });
            });
        }, 600);
    }
    function bodyScroll(param) {
        let value = param;
        if (value == false) {
            $('body').disableScroll();
        } else {
            $('body').enableScroll();
        }
    }

    function onPageLoad() {
        if (window.location.hash) {
            let url = location.hash.substr(1);
            let $formSecion = $('.ivado-form[data-name="' + url + '"]');
            let $container = $('#forms-container');
            $formSecion.add($container).show();
            // bodyScroll(false);
        }
    }
    if ($('.page-template-tpl-contact').length) {
        onPageLoad();
        if ($('#contact-page-full').length) {
            addListenerToFormButtons($(this));
            condition();
            addNormalClass();
            correctBigLabel();
        }
        if ($('.validation_error').length) {
            errorForm();
        }
        if ($('.gform_confirmation_wrapper').length) {
            confirmationForm();
        }
    }
});
