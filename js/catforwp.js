(function($){

  $(document).ready(function() {

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
        events: {
          load: function (editor, event) {
            console.log(editor);
          },
          change: function (editor, event) {

            var myRegex = 'src="(.*?[^\/\/])"',
                match   = editor.html().match(myRegex),
                input   = editor.parent().parent().find('.is-emoji-picker').data('menu');
            
                $("#emojify_section\\["+input+"\\]").val(match[1]).attr('value', match[1]);
            
            //editor.parent().parent().find('input.is-emoji-picker').attr('value',match[1]);
            //console.log(editor.parent().parent().find('.is-emoji-picker').data('menu'));
          },
        }
      });
    })
      
    // var catforwpItem = $(".is-emoji-picker").emojioneArea({
    //     standalone: true,
    //     autocomplete: false,
    //     useSprite: true,
    //     search: false,
    //     recentEmojis: false,
    //     useInternalCDN: false
    // });
    
    $(document).on("load", ".emojionearea-editor>img", function(e) {

      console.log($(this).attr('src'));
      
    });
    
  });
})(jQuery);