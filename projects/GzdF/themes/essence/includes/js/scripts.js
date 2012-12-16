jQuery(function($){
    highlightDisabled = false;
    viewHeight = $(window).height();
    
    // setup all pages heights
    setHeight = function(i, elem){
        $elem = $(elem);
        
        if($elem.outerHeight() < viewHeight){
            var height = $.browser.msie ? 'height' : 'min-height';
            $elem.css(height, viewHeight);
        }
    }
    $('.section').each(setHeight);
    $(window).resize(function(){
        $('.section').each(setHeight);
    });
});