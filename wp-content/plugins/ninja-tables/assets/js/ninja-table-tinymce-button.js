(function() {
    tinymce.create('tinymce.plugins.ninja_table', {
        init : function(editor, url) {
            editor.addButton('ninja_table', {
                title : 'Add Ninja Tables Shortcode',
                cmd : 'ninja_table_action',
                image : url.slice( 0, url.length - 2 ) + 'img/ninja-table-editor-button-2x.png',
            });
            editor.addCommand('ninja_table_action', function() {
                editor.windowManager.open({
                    title: window.ninja_tables_tiny_mce.title,
                    body: [
                        {
                            type   : 'listbox',
                            name   : 'ninja_table_shortcode',
                            label  : window.ninja_tables_tiny_mce.label,
                            values : window.ninja_tables_tiny_mce.tables
                        }
                    ],
                    width: 768,
                    height: 100,
                    onsubmit: function( e ) {
                        if( e.data.ninja_table_shortcode ) {
                            editor.insertContent( '[ninja_tables id="' + e.data.ninja_table_shortcode + '"]');
                        } else {
                            alert(window.ninja_tables_tiny_mce.select_error);
                            return false;
                        }
                    },
                    buttons: [
                        {
                            text: window.ninja_tables_tiny_mce.insert_text,
                            subtype: 'primary',
                            onclick: 'submit'
                        }
                    ]
                }, {
                    'tinymce': tinymce
                });
            });
        },
        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'ninja_table', tinymce.plugins.ninja_table );
})();
