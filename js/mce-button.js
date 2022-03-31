(function () {
    tinymce.PluginManager.add('my_mce_button', function (editor, url) {
        editor.addButton('external_link', {
            text: 'Add a Link',
            onclick: function () {
                editor.windowManager.open({
                    title: 'Insert an E-mail button',
                    body: [
                        {
                            type: 'textbox',
                            name: 'buttonLabel',
                            label: "Button Label",
                            value: "I am a button."
                        },
                        {
                            type: 'textbox',
                            name: 'buttonLink',
                            label: "Button Link",
                            value: "https://exemple.com"
                        },
                        {
                            type: 'checkbox',
                            name: 'externalLink',
                            label: "Is this link external?"
                        },
                        {
                            type: 'checkbox',
                            name: 'animeButton',
                            label: "Standard button"
                        },
                    ],
                    onsubmit: function (e) {

                        var checkbox;

                        if (e.data.externalLink === true) {
                            checkbox = 'target="_blank"';
                        } else {
                            checkbox = '';
                        }

                        if (e.data.buttonLink !== '' && e.data.buttonLabel !== '' && e.data.animeButton === false) {
                            editor.insertContent('<a ' + checkbox + ' class="btn ivado" href="' + e.data.buttonLink + '"><span class="label">' + e.data.buttonLabel + '</span></a>');
                        }

                        if (e.data.buttonLink !== '' && e.data.buttonLabel !== '' && e.data.animeButton === true) {
                            editor.insertContent('<a ' + checkbox + ' class="wisi-standard-btn" href="' + e.data.buttonLink + '">' + e.data.buttonLabel + '</a>');
                        }
                    }
                });
            }
        });
    });

})();