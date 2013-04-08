// Modified from wp-admin/js/media.dev.js
var findGalleryPosts;
(function($){
	findGalleryPosts = {
		open : function(af_name, af_val) {
			var st = document.documentElement.scrollTop || $(document).scrollTop();

			if ( af_name && af_val ) {
				$('#affected').attr('name', af_name).val(af_val);
			}
			$('#find-posts').show().draggable({
				handle: '#find-posts-head'
			}).css({'top':st + 50 + 'px','left':'50%','marginLeft':'-250px'});

			$('#find-posts-input').focus().keyup(function(e){
				if (e.which == 27) { findGalleryPosts.close(); } // close on Escape
			});

			return false;
		},

		close : function() {
			$('#find-posts-response').html('');
			$('#find-posts').draggable('destroy').hide();
		},

		send : function() {
			var post = {
				ps: $('#find-posts-input').val(),
				action: 'shiba_find_posts',
				_ajax_nonce: $('#_ajax_nonce').val()
			};

			if ( $('#find-posts-pages:checked').val() ) {
				post['type'] = $('#find-posts-pages:checked').val();
			} else {
				post['type'] = 'post';
			}
			$.ajax({
				type : 'POST',
				url : ajaxurl, //$('#ajaxurl').val(), 
				data : post,
				success : function(x) { findGalleryPosts.show(x); },
				error : function(r) { findGalleryPosts.error(r); }
			});
		},

		show : function(x) {

			if ( typeof(x) == 'string' ) {
				this.error({'responseText': x});
				return;
			}

			var r = wpAjax.parseAjaxResponse(x);

			if ( r.errors ) {
				this.error({'responseText': wpAjax.broken});
			}
			r = r.responses[0];
			$('#find-posts-response').html(r.data);
		},

		error : function(r) {
			var er = r.statusText;

			if ( r.responseText ) {
				er = r.responseText.replace( /<.[^<>]*?>/g, '' );
			}
			if ( er ) {
				$('#find-posts-response').html(er);
			}
		}
	};

	$(document).ready(function() {
		$('#find-posts-submit').click(function(e) {
			if ( '' == $('#find-posts-response').html() )
				e.preventDefault();
		});
		$('#doaction, #doaction2, #mlib_doaction').click(function(e){
			$('select[name^="action"]').each(function(){
				if ( $(this).val() == 'attach' ) {
					e.preventDefault();
					findGalleryPosts.open();
				}
			});
		});
	});
})(jQuery);
