jQuery(function($){

	$('.maisposts').click(function(){
 
		var button = $(this),
		    data = {
			'action': 'loadmore',
			'query': button_loadmore_params.posts, // that's how we get params from wp_localize_script() function
			'page' : button_loadmore_params.current_page
		};
 
		$.ajax({
			url : button_loadmore_params.ajaxurl, // AJAX handler
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Carregando ...'); // change the button text, you can also add a preloader image
			},
			success : function( data ){
				if( data ) { 
					var $newposts = $(data);

					button.text( 'Ver mais' );
					$('.lista-grid').append($newposts); // insert new posts
					button_loadmore_params.current_page++;
 
					if ( button_loadmore_params.current_page == button_loadmore_params.max_page ) 
						button.remove(); // if last page, remove the button
				} else {
					button.remove(); // if no data, remove the button as well
				}
			}
		});
	});
});