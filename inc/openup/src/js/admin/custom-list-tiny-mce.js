(function( $ ){

    tinymce.create('tinymce.plugins.OpenUpCustomListPlugin', {
        init: function(ed, url){
            ed.addButton('openup_custom_list_button', {
                title: 'Custom List',
                cmd: 'openupCustomListBtnCmd',
                image: url + '/custom-list.jpg'
            });
            ed.addCommand('openupCustomListBtnCmd', function(){
                var selectedNode = ed.selection.getNode();
                var selectedText = selectedNode.outerHTML;
                if ( selectedNode.nodeName == 'UL' ) {
                    if ( $( selectedNode ).hasClass( 'custom-bulleted-list' ) ) {
                        $( selectedNode ).removeClass( 'custom-bulleted-list' ).addClass( 'custom-striped-list' );
                    }
                    else {
                        $( selectedNode ).removeClass( 'custom-striped-list' ).addClass( 'custom-bulleted-list' );
                    }
                }
            });
        },
        getInfo: function() {
            return {
                longname : 'Drop Cap Button',
                author : 'Vadim',
            };
        }
    });
    tinymce.PluginManager.add( 'openup_custom_list_plugin', tinymce.plugins.OpenUpCustomListPlugin );

})( jQuery );