/*
	post-formats.js
	
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
	
	Copyright: (c) 2013 Jermaine Maree, http://jermainemaree.com
*/

jQuery(document).ready(function($) {

	var _custom_media = true,
	_orig_send_attachment = wp.media.editor.send.attachment;
 
	$('.media-select').click(function(e) {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		var button = $(this);
		
		_custom_media = true;
		wp.media.editor.send.attachment = function(props, attachment){
			if ( _custom_media ) {
				button.siblings('input[type=text]').val(attachment.url);
				button.siblings('#tags-thumbnail').attr('src', attachment.url);
			} else {
				return _orig_send_attachment.apply( this, [props, attachment] );
			};
		}
 
		wp.media.editor.open(button);
		return false;
	});
 
	$('.add_media').on('click', function(){
		_custom_media = false;
	});

});