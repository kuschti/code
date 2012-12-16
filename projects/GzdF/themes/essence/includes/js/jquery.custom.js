jQuery(document).ready(function($) {

	/**
	 * Custom slider navigation.
	 * Add a custom class of "slide" to menu items.
	 * 
	 * @since Essence 0.1
	 */
	$( '#fixed-navigation .scroll a' ).click(function() {
		
		$( '#fixed-navigation .scroll a' ).removeClass( 'active' );
		$( this ).addClass( 'active' );
		
		$.scrollTo( '#' + $( this ).attr( 'rel' ), {
			 duration: 750
		});
		
		return false;
	});
	
	$( '#fixed-navigation .down' ).click(function() {
		$( '.up-down a' ).removeClass( 'disabled' );
		
		var scrollTop = $( window ).scrollTop();
		var total = $( '.section' ).size();
		
		$( '.section' ).each( function( i, h2 ) {
			var h2top = $( h2 ).offset().top;
			
			if( scrollTop < h2top ) {
				$.scrollTo( h2, 750 );
								
				if( parseInt( i + 1 ) == total )
					$( '#fixed-navigation .down' ).addClass( 'disabled' );
				
				return false;
			}
		});
		
		return false;
	});
	
	$( '#fixed-navigation .up' ).click(function() {
		$( '#fixed-navigation .down' ).removeClass( 'disabled' );
		
		var scrollTop = $( window ).scrollTop();
		var total = $( '.section' ).size();

		$( '.section' ).reverse().each( function( i, h2 ) {
			var h2top = $( h2 ).offset().top;
			
			if( h2top < scrollTop ) {
				$.scrollTo( h2, 750 );
				
				if( parseInt( i + 1 ) == total )
					$( '#fixed-navigation .up' ).addClass( 'disabled' );
				
				return false;
			}
		});
		
		return false;
	});
	
	jQuery.fn.reverse = function() {
		return this.pushStack(this.get().reverse(), arguments);
	};

	/**
	 * Load the scroller for what we offer.
	 *
	 * @since Essence 0.1
	 */
	$( '.scroller' ).jCarouselLite({
        btnNext: ".next",
        btnPrev: ".previous",
		visible: 1
    });

	/**
	 * Load the thumbnails into the gallery area
	 * when viewing a portfolio item.
	 *
	 * @since Essence 0.1
	 */
	$( '#portfolio-gallery-area .portfolio-item a' ).click(function() {
		$( '#portfolio-gallery img' ).attr( 'src', $( this ).attr( 'href' ) );
		//$( '#portfolio-item-next' ).attr( 'rel', $( this ).attr( 'href' ) );
		//$( '#portfolio-item-last' ).attr( 'rel', $( this ).attr( 'href' ) );
	
		
		$.scrollTo( '#portfolio-gallery', {
            duration: 750
        });
		
		return false;
	});

	window.onscroll = function(){
		if( $( window ).scrollTop() > 0 ) {
			$( '#fixed-navigation-container' ).css({
				'position' : 'fixed',
				'top' : 0
			});
			$( '#fixed-navigation' ).css({
				'margin' : 0
			});
			$( '#fixed-navigation-container' ).addClass( 'active' );
		} else {
			$( '#fixed-navigation-container' ).css({
				'position' : 'absolute',
				'top' : 0
			});
			$( '#fixed-navigation-container' ).removeClass( 'active' );
		}
	};
	
	$( '.entry blockquote' ).prepend( '<span class="quote"></span>' );
	
	$( '#contactName, #email, #commentsText' ).placeholder();

});

/**
 * jQuery.placeholder - Placeholder plugin for input fields
 * Written by Blair Mitchelmore (blair DOT mitchelmore AT gmail DOT com)
 * Licensed under the WTFPL (http://sam.zoy.org/wtfpl/).
 * Date: 2008/10/14
 *
 * @author Blair Mitchelmore
 * @version 1.0.1
 *
 **/
new function($) {
    $.fn.placeholder = function(settings) {
        settings = settings || {};
        var key = settings.dataKey || "placeholderValue";
        var attr = settings.attr || "placeholder";
        var className = settings.className || "placeholder";
        var values = settings.values || [];
        var block = settings.blockSubmit || false;
        var blank = settings.blankSubmit || false;
        var submit = settings.onSubmit || false;
        var value = settings.value || "";
        var position = settings.cursor_position || 0;

        
        return this.filter(":input").each(function(index) { 
            $.data(this, key, values[index] || $(this).attr(attr)); 
        }).each(function() {
            if ($.trim($(this).val()) === "")
                $(this).addClass(className).val($.data(this, key));
        }).focus(function() {
            if ($.trim($(this).val()) === $.data(this, key)) 
                $(this).removeClass(className).val(value)
                if ($.fn.setCursorPosition) {
                  $(this).setCursorPosition(position);
                }
        }).blur(function() {
            if ($.trim($(this).val()) === value)
                $(this).addClass(className).val($.data(this, key));
        }).each(function(index, elem) {
            if (block)
                new function(e) {
                    $(e.form).submit(function() {
                        return $.trim($(e).val()) != $.data(e, key)
                    });
                }(elem);
            else if (blank)
                new function(e) {
                    $(e.form).submit(function() {
                        if ($.trim($(e).val()) == $.data(e, key)) 
                            $(e).removeClass(className).val("");
                        return true;
                    });
                }(elem);
            else if (submit)
                new function(e) { $(e.form).submit(submit); }(elem);
        });
    };
}(jQuery);