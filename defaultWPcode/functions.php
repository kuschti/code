*-----------------------------------------------------------------------------------*/
/* Replace p Tag around images with figure tag
/*-----------------------------------------------------------------------------------*/
function fb_unautop_4_img( $content ) {
    
    $content = preg_replace( 
        '/<p>\\s*?(<a.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
        '<figure>$1</figure>',
        $content
    );
    
    return $content;
}
add_filter( 'the_content', 'fb_unautop_4_img', 99 );