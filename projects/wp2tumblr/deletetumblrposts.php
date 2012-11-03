<?php

    $wp_import = new wp2tumblr();
    
    //************************      
    //START GENERAL PARAMETERS
    //************************

    $tumblrName = "kuimport1";                  // http://(you).tumblr.com
    $wp_import->tumblrEmail = "notify@kuschti.ch";        // tumblr login
    $wp_import->tumblrPassword = "lordxipk";         // tumblr password


	//$request = 'http://kuimport1.tumblr.com/api/read/json';

	//$ci = curl_init($request);
	//curl_setopt($ci, CURLOPT_RETURNTRANSFER, TRUE);
	//$input = curl_exec($ci);
	
	//echo $input;

	$wp_import->readtumblr();


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
        
        function readtumblr(){
        	$doc = new DOMDocument();
			$doc->load( 'http://kuimport1.tumblr.com/api/read/' );
			//$input=str_replace('var tumblr_api_read = ','',$input);
			//$input=str_replace(';','',$input);
			
			//$value = $json->decode($input);		
		}
        
		function readtumblr2(){
	        $xml = simplexml_load_file('http://kuimport1.tumblr.com/api/read/xml');
			$posts = $xml->xpath("/tumblr/posts/post[@type=ÕregularÕ]");
			foreach($posts as $post) {  
				echo $post['id'];
				echo $post['url-with-slug'];
				echo $post->{'regular-title'};
				echo $post->{'regular-body'};
				echo date("jS D M, H:i",strtotime($post['date']));
			}        
		}

        
        function wp2tumblr()
        {
            // Empty Constructor
        }
	        
	}

?>