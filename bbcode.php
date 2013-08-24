<?php 
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////  BBCode Parse v1.0
/////  Written by: Kevin Guthoerl (aka Delkathus)
/////  Created: 06/01/2013  --- http://delk.devacy.com
/////
/////  This script is free to use and to modify to deemed as fit. Only ask to have credits for this script only.
/////  Only script kiddies and uneducated fools don't credit people for their works.
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* 
------------------------------
	HOW TO USE - super easy :D
------------------------------

include this file to the main call file to Parse the require text you want to use for bbcode parsing.
It is preferred to have this include in the header for more ease. However it is not required.

	(((		include ('bbcode.php'); 	)))
	(((		parse_bbcode($text); 		))) <<< is the command to call for the parser. 

Good to use in a sql query if you are using this script for a Forum/News application. 	
	
	
/* 	Function needed to search through text for BBCode tags & Smilies */
function parse_bbcode($text, $xhtml = true)
{
	/* 	Can customize the html tags with CSS classes, can also make new bbcode tags as needed*/
	$tags = array(
		'#\[b\](.*?)\[/b\]#si' => ($xhtml ? '<strong>\\1</strong>' : '<b>\\1</b>'),
		'#\[i\](.*?)\[/i\]#si' => ($xhtml ? '<em>\\1</em>' : '<i>\\1</i>'),
		'#\[u\](.*?)\[/u\]#si' => ($xhtml ? '<span style="text-decoration: underline;">\\1</span>' : '<u>\\1</u>'),
		'#\[s\](.*?)\[/s\]#si' => ($xhtml ? '<strike>\\1</strike>' : '<s>\\1</s>'),
		'#\[color=(.*?)\](.*?)\[/color\]#si' => ($xhtml ? '<span style="color: \\1;">\\2</span>' : '<font color="\\1">\\2</font>'),
		'#\[img\](.*?)\[/img\]#si' => ($xhtml ? '<img src="\\1" />' : '<img src="\\1" >'),
		'#\[url=(.*?)\](.*?)\[/url\]#si' => '<a href="\\1" title="\\2">\\2</a>',
		'#\[email\](.*?)\[/email\]#si' => '<a href="mailto:\\1" title="Email \\1">\\1</a>',
		'#\[code\](.*?)\[/code\]#si' => '<code>\\1</code>',
		'#\[youtube\](.*?)\[/youtube\]#si' => '<iframe style="border: 1px solid #000000;" id="ytplayer" type="text/html" width="534" height="401" src="//www.youtube-nocookie.com/embed/\\1" frameborder="0"/></iframe>',
		//'#\[align=(.*?)\](.*?)\[/align\]#si' => ($xhtml ? '<div style="text-align: \\1;">\\2</div>' : '<div align="\\1">\\2</div>'),
		'#\[br\]#si' => ($xhtml ? '<br />' : '<br>'),
                '#\[h1\](.*?)\[/h1]#si' => ($xhtml ? '<h2>\\1</h2>' : '<h2>\\1</h2>'),
                '#\[h2\](.*?)\[/h2]#si' => ($xhtml ? '<h3>\\1</h3>' : '<h3>\\1</h3>'),
                '#\[h3\](.*?)\[/h3]#si' => ($xhtml ? '<h4>\\1</h4>' : '<h4>\\1</h4>'),
                '#\[ul\](.*?)\[/ul]#si' => ($xhtml ? '<ul>\\1</ul>' : '<ul>\\1</ul>'),
                '#\[ol\](.*?)\[/ol]#si' => ($xhtml ? '<ol>\\1</ol>' : '<ol>\\1</ol>'),
                '#\[li\](.*?)\[/li]#si' => ($xhtml ? '<li>\\1</li>' : '<li>\\1</li>'),
                '#\[center\](.*?)\[/center]#si' => '<center>\\1</center>',
                '#\[style="(.*?)"\](.*?)\[/style\]#si' => '<span style="\\1" >\\2</span>',
                '#\[style=\'(.*?)\'\](.*?)\[/style\]#si' => '<span style="\\1" >\\2</span>',
	);
	
	/* 	It is optimal to have smilies as complex as possible but not retardedly complex. 
		This is so that the [CODE] tags won't display smilies. 
		
		Can also use BBCode as smilies if you want to instead of doing the smilies array.
		I will make this optional in version 2.0.
		
	*/	// TODO: Configure smilies
	/*$smilies = array(
		':-)' => '<img src="images/smile/smiley.png" border="0" alt="Smile" title="Smile" />',
		':-(' => '<img src="images/smile/sad.png" border="0" alt="Sad" title="Sad" />',
		':-D' => '<img src="images/smile/happy.png" border="0" alt="Big Grin" title="Big Grin" />',
		';;' => '<img src="images/smile/cry.png" border="0" alt="Cry" title="Cry" />',
		':-s' => '<img src="images/smile/conf.png" border="0" alt="Confused" title="Confused" />',
		':-|' => '<img src="images/smile/neutral.png" border="0" alt="Meh" title="Meh" />',
		':-x' => '<img src="images/smile/kiss.png" border="0" alt="Smooches" title="Smooches" />',
		';-)' => '<img src="images/smile/wink.png" border="0" alt="Wink" title="Wink" />',
		':-*' => '<img src="images/smile/blush.png" border="0" alt="Blush" title="Blush" />',
		':-3' => '<img src="images/smile/kitty.png" border="0" alt="Kitty" title="Kitty" />',
		'8-|' => '<img src="images/smile/eek.png" border="0" alt="Eek" title="Eek" />',
		':-@' => '<img src="images/smile/fat.png" border="0" alt="Lazy" title="Lazy" />',
		':-z' => '<img src="images/smile/sleep.png" border="0" alt="Sleep" title="Sleep" />'
		// etc
	);*/
	
	/* foreach will look at each word to see if it contains the pre-req's for bbcode or smilies */
	foreach ($tags AS $search => $replace)
	{
		$text = preg_replace($search, $replace, $text);
	}
	
	/*foreach ($smilies AS $search => $replace)
	{
		$text = str_replace($search, $replace, $text);
	}
         */ 
	// this returns the completed result
        
	return $text;
}

function parse_html($text, $xhtml = TRUE){
    
    $tags = array(
            '#<strong>(.*?)</strong>#si' => '[b]\\1[/b]',   // bold font
            '#<b>(.*?)</b>#si' => '[b]\\1[/b]',
            '#<em>(.*?)</em>#si' => '[i]\\1[/i]',           // italic font
            '#<i>(.*?)</i>#si' => '[i]\\1[/i]',
            '#<u>(.*?)</u>#si' => '[u]\\1[/u]',             // Underline. Note: span[style] allowed in HTMLPurifier.
            '#<s>(.*?)</s>#si' => '[s]\\1[/s]',             // Strikethrough
            '#<font color="(.*?)">(.*?)</font>#si' => '[color=\\1]\\2[/color]', // Font color. Note: span[style] allowed in HTMLpurifier
            '#<img src="(.*?) />#si' => '[img]\\1[/img]',
            '#<img src="(.*?) >#si' => '[img]\\1[/img]',
            '#<a href="(.*?)" title="(.*?)">(.*?)</a>#si' => '[url=\\1]\\3[/url]',
            '#<a href="mailto:"(.*?)" title="Email (.*?)">(.*?)</a>#si' => '[email]\\1[/email]',
            '#<code>(.*?)</code>#si' => '[code]\\1[/code]',
            '#<iframe style="(.*?)" id="ytplayer" type="text/html" width="534" height="401" src="(.*?)/embed/(.*?)" frameborder="0"/></iframe>#si' => '[youtube]\\3[/youtube]',
            '#<br />#si' => '[br]',
            '#<br>#si' => '[br]',
            '#<h2>(.*?)</h2>#si' => '[h1]\\1[/h1]',
            '#<h3>(.*?)</h3>#si' => '[h2]\\1[/h2]',
            '#<h4>(.*?)</h4>#si' => '[h3]\\1[/h3]',
            '#<ul>(.*?)</ul>#si' => '[ul]\\1[/ul]',
            '#<ol>(.*?)</ol>#si' => '[ol]\\1[/ol]',
            '#<li>(.*?)</li>#si' => '[li]\\1[/li]',
            '#<center>(.*?)</center>#si' => '[center]\\1[/center]',
            '#<span style="(.*?)" >(.*?)</span>#si' => '[style="\\1"]\\2[/style]',
            '#<span style="(.*?)">(.*?)</span>#si' => '[style="\\1"]\\2[/style]',

    );

    foreach ($tags as $search => $replace) {
        $text = preg_replace($search, $replace, $text);
    }
    return $text;
}
?>
