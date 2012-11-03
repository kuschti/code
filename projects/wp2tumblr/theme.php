<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <!-- DEFAULT VARIABLES -->
    <meta name="color:Background" content="#efe8ce" />
    <meta name="font:Body" content="Arial" />
    <meta name="if:Show People I Follow" content="1" />
    <meta name="if:Show Tags" content="1" />
    <meta name="if:Show Album Art on Audio Posts" content="1" />
    <meta name="text:Disqus Shortname" content="" />
    <meta name="image:Header" value="" />
    <meta name="image:Background" content="" />
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{Title}{block:SearchPage}, Search results for: {SearchQuery}{/block:SearchPage}{block:PostSummary}, {PostSummary}{/block:PostSummary}</title>
    {block:Description}<meta name="description" content="{MetaDescription}" />{/block:Description}
    <link rel="shortcut icon" href="{Favicon}" />
    <link rel="alternate" type="application/rss+xml" href="{RSS}" />
	
	<!-- CSS -->     
   	<link rel="stylesheet" type="text/css" href="http://kuschti.ch/src/tumblr/style.css"/> 
   	<link rel="stylesheet" type="text/css" href="http://kuschti.ch/src/tumblr/disqus.css"/>
    
    <!--[if lt IE 7.]>
    	<link rel="stylesheet" type="text/css" href="http://kuschti.ch/src/tumblr/IE7.css"/> 
    <![endif]-->
    
    <!--[if lt IE 8.]>
    	<link rel="stylesheet" type="text/css" href="http://kuschti.ch/src/tumblr/IE8.css"/> 
    <![endif]-->
    <style type="text/css">
    	body {
    		background-color: {color:Background};
    		background-image: url('{image:Background}');
    		font-family: {font:Body};
 	   	}	
    </style>
    <style type="text/css">{CustomCSS}</style>
</head>
<body>
    <div id="wrapper">
        <div id="title">
            <a href="/">
                {block:IfHeaderImage}<img src="{image:Header}" />{/block:IfHeaderImage}
                {block:IfNotHeaderImage}{Title}{/block:IfNotHeaderImage}
            </a>
        </div>
        <!--2-->
        <div id="content">
            
            {block:SearchPage}
                <div id="searchresults" class="searchresultcount">{SearchResultCount} results for <strong>"{SearchQuery}"</strong></div>
            {/block:SearchPage}
            
            {block:NoSearchResults}
                <style type="text/css">
                    .searchresultcount {
                        display: none;
                    }
                </style>
                <div id="searchresults">No results for <strong>"{SearchQuery}"</strong></div>
            {/block:NoSearchResults}
            
            {block:Posts}            
                <div class="post">
                    
                    {block:Photo}
                        <div class="media">{LinkOpenTag}<img src="{PhotoURL-500}" alt="{PhotoAlt}" />{LinkCloseTag}</div>
                        {block:Caption}<div class="copy">{Caption}</div>{/block:Caption}
                    {/block:Photo}
                    
                    {block:Video}
                        <div class="media">{Video-500}</div>
                        {block:Caption}<div class="copy">{Caption}</div>{/block:Caption}
                    {/block:Video}
                
                    {block:Audio}
                        {block:IfShowAlbumArtOnAudioPosts}
                            {block:AlbumArt}
                                <div class="album_art">
                                    <img src="{AlbumArtURL}" alt="{block:Artist}{Artist}{/block:Artist}{block:TrackName} - {TrackName}{/block:TrackName}" style="margin-bottom: 10px" />
                                </div>
                            {/block:AlbumArt}
                        {/block:IfShowAlbumArtOnAudioPosts}
                        
                        <div class="audio">
                            <div class="player">{AudioPlayerWhite}</div>
                            <div class="meta">{PlayCountWithLabel}{block:ExternalAudio} &bull; <a href="{ExternalAudioURL}">download</a>{/block:ExternalAudio}</div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        {block:Caption}<div class="copy">{Caption}</div>{/block:Caption}
                    {/block:Audio}
                    
                    {block:Quote}
                        <div class="quote {Length}">{Quote}</div>
                        <div class="copy">
                            <div class="quotebg">“</div>
                            {block:Source}
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td valign="top" style="width: 20px">&mdash;</td>
                                        <td valign="top" class="quote_source">
                                            {Source}
                                        </td>
                                    </tr>
                                </table>
                            {/block:Source}
                        </div>
                    {/block:Quote}
                        
                    {block:Text}
                        {block:Title}<div class="title">{Title}</div>{/block:Title}
                        <div class="copy">{Body}</div>
                    {/block:Text}
                    
                    {block:Answer}
                        <div class="question">
                            <div class="nip"></div>
                            {Question}
                        </div>
                        <div class="asker_container"><img src="{AskerPortraitURL-24}">{Asker}</div>
                        <div class="copy">{Answer}</div>
                    {block:Answer}
                
                    {block:Chat}
                        {block:Title}<div class="title">{Title}</div>{/block:Title}
                        <div class="chat">
                            <div class="lines">
                                {block:Lines}
                                    <div class="line {Alt}">{block:Label}<strong>{Label}</strong>{/block:Label} {Line}</div>
                                {/block:Lines}
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div style="height: 10px"></div>
                    {/block:Chat}
                    
                    {block:Link}
                        <div class="link"><a href="{URL}" {Target}>{Name} &raquo;</a></div>
                        {block:Description}<div class="copy">{Description}</div>{/block:Description}
                    {/block:Link}
                    
                    <a href="{Permalink}">
                        <div class="footer">
                            <div class="date">
                                {block:Reblog}Reblogged{/block:Reblog}
                                {block:NotReblog}Posted{/block:NotReblog}
                                
                                {TimeAgo}
                                
                                {block:Reblog}from {ReblogParentName} {block:RebloggedFromReblog}(originally from {ReblogRootName}){block:RebloggedFromReblog}{/block:Reblog}
                                {block:FromBookmarklet}from bookmarklet{/block:FromBookmarklet}
                                {block:FromMobile}from mobile{/block:FromMobile}
                            </div>
                            <div class="notes">{block:NoteCount}{NoteCountWithLabel}{/block:NoteCount} {block:IfDisqusShortname}{block:NoteCount}&bull;{/block:NoteCount} <a href="{Permalink}#disqus_thread">view comments</a>{/block:IfDisqusShortname}</div>
                            <div class="clear"></div>
                        </div>
                    </a>
                    
                    {block:IfShowTags}
                        {block:HasTags}<div class="footer"><div class="tags">Tagged: {block:Tags}<a href="{TagURL}">{Tag}</a><span class="tag-commas">, </span>{/block:Tags}.</div></div>{/block:HasTags}
                    {/block:IfShowTags}
                    
                    {block:PostNotes}<div class="notecontainer">{PostNotes}</div>{/block:PostNotes}
                    
                    {block:IfDisqusShortname}
                        {block:Permalink}
                            <div class="notecontainer" style="margin: 20px 0 1px 0; padding: 1px 10px 10px 10px;">
                                <div id="disqus_thread"></div>
                                <script type="text/javascript" src="http://disqus.com/forums/{text:Disqus Shortname}/embed.js"></script>
                                <noscript><a href="http://{text:Disqus Shortname}.disqus.com/?url=ref">View the discussion thread.</a></noscript>
                            </div>
                            <div style="text-align: right; margin-top: 5px">
                                <a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
                            </div>
                        {/block:Permalink}
                    {/block:IfDisqusShortname}
                    
                </div>
                <div class="bottom"></div>
            {/block:Posts}
            
            {block:Pagination}
                <div id="navigation">
                    {block:PreviousPage}<a href="{PreviousPage}">&larr; previous page</a>{/block:PreviousPage}
                    {block:NextPage}<a href="{NextPage}">next page &rarr;</a>{/block:NextPage}
                </div>
            {/block:Pagination}
            
        </div>
        
        <div id="sidebar">
            <div id="top">
                <div id="avatar"><a href="/"><img src="{PortraitURL-128}" /></a></div>
                <div id="description">{Description}</div>
                
                <div id="search">
                    <form action="/search" method="get" id="search-form">
                        <input type="hidden" name="t" value="{Name}" />
                        <input type="hidden" name="scope" value="all_of_tumblr" />
                        <input type="text" name="q" class="query" value="{SearchQuery}" />
                        <input type="submit" value="Search" class="submit" />
                        <div class="clear"></div>
                    </form>
                </div>
                <div id="search-scope">
                    <input type="radio" id="search-scope-me" name="scope" checked onclick="document.getElementById('search-form').action='/search'" /> <label for="search-scope-me" onclick="document.getElementById('search-form').action='/search'">My Blog</label>
                    <input type="radio" id="search-scope-all" name="scope" onclick="document.getElementById('search-form').action='http://tumblr.com/search'" /> <label for="search-scope-all" onclick="document.getElementById('search-form').action='http://tumblr.com/search'">All of Tumblr</label>
                </div>
                
                <a href="http://www.tumblr.com/follow/{Name}"><div class="heading" id="followontumblr">Follow on Tumblr</div></a>
                
                {block:Twitter}
                <div id="twitterwrapper" style="display: none">
                    <a href="http://twitter.com/{TwitterUsername}" style="text-decoration: none"><div class="heading" id="twitter">Latest Tweets</div></a>
                    <div id="tweetcontainer"></div>
                    <script type="text/javascript">
                        function recent_tweets(data) {
                            document.getElementById("twitterwrapper").style.display = "block";
                            for(i = 0; i < data.length; i++) {
                                document.getElementById("tweetcontainer").innerHTML = document.getElementById("tweetcontainer").innerHTML + '<a href="http://twitter.com/{TwitterUsername}/status/' + data[i].id + '"><div class="content">' + data[i].text + '</div></a>';
                            }
                        }
                    </script>
                </div>
                {/block:Twitter}
                
                {block:IfShowPeopleIFollow}
                    {block:Following}
                        <div class="heading" id="following">Following</div>
                        <div class="content" id="following-avatars">
                            {block:Followed}<a href="{FollowedURL}"><img src="{FollowedPortraitURL-40}" /></a>{/block:Followed}
                        </div>
                    {/block:Following}
                {/block:IfShowPeopleIFollow}
                
                <div id="buttons">
                    <div class="row">
                        <div class="button" id="button-rss"><a href="{RSS}">RSS Feed</a></div>
                        <div class="button" id="button-random"><a href="/random">Random</a></div>
                    </div>
                    <div class="clear"></div>
                    <div class="row">
                        <div class="button" id="button-archive"><a href="/archive">Archive</a></div>
                        <div class="button" id="button-mobile"><a href="/mobile">Mobile</a></div>
                    </div>
                    <div class="clear"></div>
                </div>
                
            </div>
            
            <div id="bottom"></div>
            <div id="copyright">&copy; {CopyrightYears} <a href="http://www.tumblr.com">Powered by Tumblr</a></div>
        </div>
        
        <div class="clear"></div>
    </div>
    
    {block:Twitter}
        <script type="text/javascript" src="/tweets.js"></script>
    {/block:Twitter}
    
    {block:IfDisqusShortname}
        <script type="text/javascript">
            //<![CDATA[
            (function() {
                var links = document.getElementsByTagName('a');
                var query = '?';
                for(var i = 0; i < links.length; i++) {
                    if(links[i].href.indexOf('#disqus_thread') >= 0) {
                        query += 'url' + i + '=' + encodeURIComponent(links[i].href) + '&';
                    }
                }
                document.write('<script charset="utf-8" type="text/javascript" src="http://disqus.com/forums/{text:Disqus Shortname}/get_num_replies.js' + query + '"></' + 'script>');
            })();
            //]]>
        </script>
    {/block:IfDisqusShortname}
</body>
</html>