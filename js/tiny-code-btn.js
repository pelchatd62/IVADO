(function() {
    tinymce.create('tinymce.plugins.Tryvary', {
        init : function(ed, url) {
            ed.addButton('CTA_bouton', {
                title : 'Bouton CTA',
                cmd : 'CTA_bouton',
                icon: 'newtab'
            });

            ed.addCommand('CTA_bouton', function() {
                ed.windowManager.open({
                    title: 'Bouton CTA',
                    body: [{
                        type: 'textbox',
                        name: 'lien',
                        placeholder: 'Entrez le lien',
                        multiline: true,
                        minWidth: 700,
                        minHeight: 30,
                    },{
                        type: 'textbox',
                        name: 'texte',
                        placeholder: 'Texte',
                        multiline: true,
                        minWidth: 700,
                        minHeight: 30,
                    },{
                        type: 'checkbox',
                        name: 'alignement',
                        text: ' Centré?',
                     
                    }],
                    onsubmit: function( e ) {
                        ed.insertContent( '[CTA_shortcode lien="'+e.data.lien+'" centre="'+e.data.alignement+'"]'+e.data.texte+'[/CTA_shortcode]');
                    }
                });
            });
        },
    });
    tinymce.PluginManager.add( 'CTA_bouton', tinymce.plugins.Tryvary);
})();