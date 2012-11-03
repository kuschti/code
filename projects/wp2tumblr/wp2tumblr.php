<?php
//
// Title: wp2Tumblr.php
// Version: 1.2
// Author: Darshan Bavaria (http://www.dbavaria.com)
// Author_Contact: dbavaria@gmail.com
// License: GNU General Public License (http://www.gnu.org/copyleft/gpl.html)
// Parts of this code are derived from WordPress (http://wordpress.org/) under GPL
//
// Description: 
// This script will parse a specified WordPress export file and transfer its
// contents to a tumblr blog and optionally a disqus forum. The script is written
// in php and is partly based off WordPress's import code
//
// Don't run the script if you don't know what it does. This script was a quick
// coding exercise so it does not have fancy error handling. Use it at your
// own risk.
// 
// Directions:
// - Install the script on a server that supports PHP 5
// - Export your WordPress blog: Wordpress Version 2.3.3: Manage -> Export -> Download Export File
// - Edit the script and input your general parameters
// - Run the script by invoking its url with the following query string: ?exec=true
//
// Updates:
//    - 1.3: Updated comment posting code to work with changes on Disqus's side
//    - 1.2: Post and Comment content is now formatted in paragraph style like wordpress
//    - 1.1: Some WordPress exports were invalid XML so DOM based parsing was replaced
//      with parsing code directly from WordPress's own Import function
//
// If you like the script use it and drop me comments! If you hate the script
// fix it and or drop me comments! The script is available for free and to be
// modified under the above mentioned license. Please attribute the original
// and modified versions to the respective authors.
//
// dbavaria@gmail.com
//



    $wp_import = new wp2tumblr();
    
    //************************      
    //START GENERAL PARAMETERS
    //************************

    $wp_import->wordPressXmlURL = "/home/kuschtic/public_html/src/tumblr/wordpress2.xml";   // LOCAL path to wordpress export file
    $wp_import->tumblrName = "http://kuimport2.tumblr.com";                  // http://(you).tumblr.com
    $wp_import->tumblrEmail = "notify@kuschti.ch";        // tumblr login
    $wp_import->tumblrPassword = "lordxipk";         // tumblr password
    $wp_import->disqusName = "kuimport.disqus.com";                  // http://(you).disqus.com
    $wp_import->startID = "176";			//Start des Imports nach dieser POST-ID
    
    $wp_import->transferComments =false;             // Transfer Comments to Disqus


    //***********************      
    //END GENERAL PARAMETERS
    //***********************
    
    $wp_import->parsePosts();
    $wp_import->transferPosts();

    class wp2tumblr {
        
        // account specific paramters
        var $tumblrName;
        var $tumblrEmail;
        var $tumblrPassword;
        var $disqusName;
        
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
                
                $pausecount = $pausecount+1;
                if($pausecount == 10) {
                sleep(60);
                $pausecount = 0;
                }
                //Create POST data for tumblr
                $tumblrPostData = http_build_query(array('email'     => $this->tumblrEmail,
                'password'  => $this->tumblrPassword,
                'date'      => $post['post_date'],
                'title'     => $post['post_title'],
                'body'      => $post['post_content'],
                'tags'		=> $post['post_tags'],
                'type'      => 'regular',
                'generator' => 'WordPress to Tumblr',
                ));
                
                //POST content to tumblr and return new postId

                $tumblrPostId = $this->postHandler($tumblrPostData);
                
                $tumblrPostId = trim($tumblrPostId);
                //if (!is_numeric($tumblrPostId)) {
                //    die("POST returned invalid result: $tumblrPostId");
                //}
                
                echo "$number<br/><b>WordPress " . $post['post_ID'] . " -> Tumblr $tumblrPostId</b><br/>";
                
                if (sizeof($post['commentdata']) > 0 && $this->transferComments == true) {
                    
                    //Get the disqus 'threadSlug' - comment thread identifier for a particular blog post
                    $disqusThreadSlug = $this->getDisqusSlug("http://$this->tumblrName.tumblr.com/post/$tumblrPostId", $this->disqusName);
                    if ($disqusThreadSlug=="") {
                        die("Failed to get a valid disqus threadSlug!");
                    }
                    
                    $commentNum = 0;
                    foreach($post['commentdata'] as $comment){
                        //Create POST data for disqus
                        $disqusPostData = http_build_query(array(
                        'create_user'        => 'Choose+Username+*',
                        'create_password'    => 'Choose+Password+*',
                        'login_user'         => 'Email+or+Username',
                        'login_password'     => 'Password',
                        'from_embed'         => '1',
                        'to_redirect'        => '',
                        'parent'             => "http://$this->tumblrName.tumblr.com/post/$tumblrPostId",
                        'author_name'        => $comment['comment_author'],
                        'author_email'       => $comment['comment_author_email'],
                        'author_url'         => $comment['comment_author_url'],
                        'message'            => $comment['comment_content']
                        ));
                        
                        //POST comment to disqus
                        $this->postHandler("http://disqus.com/forums/$this->disqusName/$disqusThreadSlug/", $disqusPostData);
                        
                        $commentNum++;
                        echo "<i>Comment $commentNum of " . sizeof($post['commentdata']) . " posted to Disqus</i><br/>";
                    }
                }
                echo "<br/><br/>";
            }
        }
        
        function postHandler($queryString)
        {
            //POST data to a URL using CURL
            //$session = curl_init($url);
            //curl_setopt($session, CURLOPT_POST, true);
            //curl_setopt($session, CURLOPT_POSTFIELDS, $queryString);
            //curl_setopt($session, CURLOPT_HEADER, false);
            //curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
            //$retVal = curl_exec($session);
            //curl_close($session);
            //return $retVal;
			
			// Send the POST request (with cURL)
			$c = curl_init('http://www.tumblr.com/api/write');
			curl_setopt($c, CURLOPT_POST, true);
			curl_setopt($c, CURLOPT_POSTFIELDS, $queryString);
			curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($c);
			$status = curl_getinfo($c, CURLINFO_HTTP_CODE);
			curl_close($c);
			
			// Check for success
			if ($status == 201) {
				echo "Success! The new post ID is $result.\n";
			} else if ($status == 403) {
				echo 'Bad email or password';
			} else {
				die("Error: $result\n");
			}
			
			return $result;
		}
        
        function getDisqusSlug($blogPostURL, $disqusName)
        {
            //Load disqus's thread.js for particular blog post
            $url = "http://disqus.com/forums/$this->disqusName/thread.js?url=$blogPostURL&message=&title=";
            $retVal = $this->postHandler($url, "");
            
            //Parse thread.js and return the "threadSlug"
            $regexp = "&f=$this->disqusName&t=(.*)&to_redirect=";

            $re1='(\'\\?slug=\')';	# Single Quote String 1
            $re2='(\\s+)';	# White Space 1
            $re3='(\\+)';	# Single Character 1
            $re4='(\\s+)';	# White Space 2
            $re5='(\\\'.*?\\\')';	# Single Quote String 2
          
            if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5."/is", $retVal, $matches))
            {
                $slug = $matches[5][0];
                $slug = str_replace("'", "", $slug);
                return $slug;
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
            $post_status     = $this->get_tag($post, 'wp:status' );
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
            
            if ($comments) {
                foreach($comments as $comment) {
                    $comment_post_ID      = $post_ID;
                    $comment_author       = $this->get_tag($comment, 'wp:comment_author');
                    $comment_author_email = $this->get_tag($comment, 'wp:comment_author_email');
                    $comment_author_url   = $this->get_tag($comment, 'wp:comment_author_url');
                    $comment_date         = $this->get_tag($comment, 'wp:comment_date');
                    $comment_approved     = $this->get_tag($comment, 'wp:comment_approved');
                    
                    $comment_content      = $this->get_tag($comment, 'wp:comment_content');
                    $comment_content      = $this->wpautop($comment_content);
                    
                    if ($comment_approved == 1) {
                        $commentdata[] = compact('comment_post_ID', 'comment_author', 'comment_author_url', 'comment_author_email', 'comment_date', 'comment_content');
                    }
                }
            }
            $postdata = compact('post_ID', 'post_date', 'post_content', 'post_title', 'commentdata', 'post_tags', 'post_category');
            return $postdata;
        }
        
        function wp2tumblr()
        {
            // Empty Constructor
        }
    }

?>