<?php

    $wp_import = new wp2tumblr();
    
    //************************      
    //START GENERAL PARAMETERS
    //************************

    $wp_import->wordPressXmlURL = "/home/kuschtic/public_html/src/tumblr/wordpresstest.xml";   // LOCAL path to wordpress export file


    //***********************      
    //END GENERAL PARAMETERS
    //***********************
    
    $wp_import->parsePosts();
    $wp_import->transferPosts();

    class wp2tumblr {
        
        
        // other parameters
        var $wordPressXmlURL;
        var $transferComments;

        // post storage
        var $rawPosts = array();
        var $posts = array();
        var $pausecount = 0;
        
        function transferPosts()
        {
            foreach($this->posts as $post){

            }
        }
        
        function parsePosts()
        {
            $this->get_entries();
            $this->process_posts();
        }
        
        //Source: http://www.php.net/html_entity_decode
        function unhtmlentities($string)
        {
            // replace numeric entities
            $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
            $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
            // replace literal entities
            $trans_tbl = get_html_translation_table(HTML_ENTITIES);
            $trans_tbl = array_flip($trans_tbl);
            return strtr($string, $trans_tbl);
        }
        
        //All code below is a hacked up version of WordPress 2.3.3
        //Source: \wordpress\wp-admin\import\wordpress.php
        
        function get_tag($string, $tag )
        {
            preg_match("|<$tag.*?>(.*?)</$tag>|is", $string, $return);
            
            $searchCDATA = array('<![cdata[', ']]>');
            $replaceCDATA = array('', '');
            $return = str_ireplace($searchCDATA, $replaceCDATA, $return[1]);
            
            $return = trim($return);
            
            return $return;
        }

		// Tags auslesen und Komma-getrennt zurueckgeben
		function get_tags($string, $tag )
        {
            preg_match_all('|<category.*? domain="tag" nicename.*?>(.*?)</category>|is', $string, $return);
			$searchCDATA = array('<![cdata[', ']]>');
            $replaceCDATA = array('', '');
            $return = str_ireplace($searchCDATA, $replaceCDATA, $return[1]);											
			$return = implode(",", $return);			
            
            return $return;
        }

        
        // Ugly mess that wordpress uses to auto-paragraphize post content 
        function wpautop($pee, $br = 1) {
            	$pee = $pee . "\n"; // just to make things a little easier, pad the end
            	$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
            	// Space things out a little
            	$allblocks = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr)';
            	$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
            	$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
            	$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
            	$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
            	$pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $pee); // make paragraphs, including one at the end
            	$pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
            	$pee = preg_replace('!<p>([^<]+)\s*?(</(?:div|address|form)[^>]*>)!', "<p>$1</p>$2", $pee);
            	$pee = preg_replace( '|<p>|', "$1<p>", $pee );
            	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
            	$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
            	$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
            	$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
            	$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
            	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
            	

            	if ($br) {
            		$pee = preg_replace('/<(script|style).*?<\/\\1>/se', 'str_replace("\n", "<WPPreserveNewline />", "\\0")', $pee);
            		$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
            		$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
            	}
            	$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
            	$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
            	
            	$pee = preg_replace( "|\n</p>$|", '</p>', $pee );
            
            	return $pee;
        }
        
        function get_entries()
        {
            set_magic_quotes_runtime(0);
            
            $this->rawPosts = array();
            
            $num = 0;
            $doing_entry = false;
            
            $fp = fopen($this->wordPressXmlURL, 'r');
            if ($fp) {
                while (!feof($fp) ) {
                    $importline = rtrim(fgets($fp));
                    
                    if (false !== strpos($importline, '<item>') ) {
                        $this->rawPosts[$num] = '';
                        $doing_entry = true;
                        continue;
                    }
                    if (false !== strpos($importline, '</item>') ) {
                        $num++;
                        $doing_entry = false;
                        continue;
                    }
                    if ($doing_entry ) {
                        $this->rawPosts[$num] .= $importline . "\n";
                    }
                }
                
                fclose($fp);
            }
        }
        
        function process_posts()
        {
            foreach($this->rawPosts as $post) {
                $result = $this->process_post($post);
                if (is_null($result) == false) {
                    $this->posts[] = $result;
                }
            }
        }
        
        function process_post($post)
        {
            $postdata = array();
            $commentdata = array();
            
            $post_ID        = (int) $this->get_tag($post, 'wp:post_id' );
            $post_date      = $this->get_tag($post, 'wp:post_date' );
            $post_type      = $this->get_tag($post, 'wp:post_type' );
            $post_status    = $this->get_tag($post, 'wp:status' );
            $post_category  = $this->get_tag($post, 'category' );
			$post_tags  	= $this->get_tags($post, 'category' );
            
            $post_title     = $this->get_tag($post, 'title' );
            $post_title     = $this->unhtmlentities($post_title);
            
            $post_content = $this->get_tag($post, 'content:encoded' );
            $post_content = preg_replace('|<(/?[A-Z]+)|e', "'<' . strtolower('')", $post_content);
            $post_content = str_replace('<br>', '<br />', $post_content);
            $post_content = str_replace('<hr>', '<hr />', $post_content);
            $post_content = $this->wpautop($post_content);

            
            if ($post_type != "post" || $post_status == "draft" || $post_status == "private") {
                return null;
            }
            
            preg_match_all('|<wp:comment>(.*?)</wp:comment>|is', $post, $comments);
            $comments = $comments[1];
            
            $postdata = compact('post_ID', 'post_date', 'post_content', 'post_title', 'commentdata', 'post_tags', 'post_category');
			echo "ID: ".$post_ID."<br />";
			echo "Datum: ".$post_date."<br />";
			echo "Type: ".$post_type."<br />";
			echo "Status: ".$post_status."<br />";
			echo "Kategorie: ".$post_category."<br>";
			echo "Tags: ".$post_tags."<br>";
			echo "Title: ".$post_title."<br />";
			echo "Content: <br />".$post_content."<br>-------------<br>";
        }
        
        function wp2tumblr()
        {
            // Empty Constructor
        }
    }

?>