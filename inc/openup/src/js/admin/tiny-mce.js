(function( $ ){

    tinymce.create('tinymce.plugins.OpenUpDropCapPlugin', {
        init: function(ed, url){
            ed.addButton('openup_dropcap_button', {
                title: 'Drop Cap',
                cmd: 'openupDropCapBtnCmd',
                image: url + '/dropcap.jpg'
            });
            ed.addCommand('openupDropCapBtnCmd', function(){
                var selectedNode = ed.selection.getNode();
                var selectedText = selectedNode.outerHTML;
                var parent = false;
                let pattern = /class=.has-dropcap./;
                if ( $( selectedNode ).parent().hasClass( 'has-dropcap' ) ) {
                    parent = selectedNode.parentNode;
                    if ( pattern.test( parent.outerHTML ) ) {
                        parent.remove();
                    }
                }
                else {
                    let cssClass = 'has-dropcap';
                    pattern = /<h2>/;
                    if ( pattern.test( selectedText ) ) {
                        cssClass = 'has-dropcap--h2';
                    }
                    selectedText = '<div class="' + cssClass + '">' + selectedText + '</div>';
                }
                ed.execCommand('mceInsertContent', 0, selectedText);
           });
        },
        getInfo: function() {
            return {
                longname : 'Drop Cap Button',
                author : 'Vadim',
            };
        }
    });
    tinymce.PluginManager.add( 'openup_dropcap_plugin', tinymce.plugins.OpenUpDropCapPlugin );

})( jQuery );