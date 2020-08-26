'use strict';
(function($){

  $(document).ready(function() {

    /* CSS Custom Code Mirror */

    if( $('#cat_custom_style').length ) {
      var editorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {};
      editorSettings.codemirror = _.extend(
          {},
          editorSettings.codemirror,
          {
              indentUnit: 2,
              tabSize: 2,
              mode: 'css',
          }
      );
      var editor = wp.codeEditor.initialize( $('#cat_custom_style'), editorSettings );
    }

    /* Emojify Picker */

    var entityMap = {
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;',
      '/': '&#x2F;',
      '`': '&#x60;',
      '=': '&#x3D;'
    };
    
    function escapeHtml (string) {
      return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
      });
    }

    function getURL( string ){
      var myRegex = 'src="(.*?[^\\])"';
      var match = myRegex.exec(string);
      return match[1];
    }

    $('.is-emoji-picker').each( function(){
      
      $(this).emojioneArea({
        standalone: true,
        autocomplete: false,
        useSprite: true,
        search: false,
        recentEmojis: false,
        useInternalCDN: true,
        pickerPosition: "right",
        hidePickerOnBlur: false,
        events: {
          load: function (editor, event) {
            console.log(editor);
          },
          change: function (editor, event) {

            var myRegex = 'src="(.*?[^\/\/])"',
                match   = editor.html().match(myRegex),
                input   = editor.parent().parent().find('.is-emoji-picker').data('menu');
            
                $("#emojify_section\\["+input+"\\]").val(match[1]).attr('value', match[1]);
          },
        }
      });
    })
  });
})(jQuery);