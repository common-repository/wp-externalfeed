<?php

/*
Plugin Name: WP-ExternalFeed
Plugin URI: http://vagrantconcept.com/downloads/wp-externalfeed
Description: Lists feed links from del.icio.us, Technorati, Reddit, Digg and TailRank that is relevant to the current category. For a demo, see my other project: <a href="http://morpheed.com">Morpheed.com</a>.
Author: Justin Wong
Version: 1.3
License: GPL
Author URI: http://vagrantconcept.com
*/ 

/*
Original: Dave Wolf, http://www.davewolf.net
Modified by (Version 1.1 rev1): Thomas Fischer, http://www.securityfocus.de
Modified by Frank Bueltge, http://www.bueltge.de/wp-rss-import-plugin/55/
Modified by Justin Wong, http://www.wongkeenhing.com/projects/wp-plugins

I took the code from Inlinefeed and modified it. I needed the RSS feeds to correspond to the current category so I input the URL within the code itself. 

*/

require_once(ABSPATH.'wp-includes/rss-functions.php');

define('MAGPIE_CACHE_ON', false);

function Delicious($display=0,$displaydescriptions=false,$truncatetitle=true) {

$current_category = single_cat_title("", false);
$delifeed="http://del.icio.us/rss/tag/".$current_category ;
$deliicon="<a href='". $delifeed ."'><img src=\"http://images.del.icio.us/static/img/delicious.med.gif\"></a>" ;

    if ( $delifeed ) {
    $rss = fetch_rss( $delifeed );

		echo wptexturize("<br />" . $deliicon . "<b>" . "del.icio.us" . "</b><br />");
				foreach ($rss->items as $item) {
								if ($display == 0) {
								break;
								}
								$href = $item['link'];
								$desc = trim($item['description']);
								$item['fulltitle']=$item['title'];
									$umlaute = array('�','�','�','�','�','�','�','�','�',"“","�?","’","–","—","…","&nbsp;",chr(196), chr(228),chr(214),chr(246),chr(220),chr(252),chr(223),chr(175),chr(174),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('?'),utf8_encode('�'),utf8_encode('�'));
									$htmlcode = array('&auml;','&ouml;','&uuml;','&szlig;','&Auml;','&Ouml;','&Uuml;','&raquo;','&laquo;','"','"','�','�','�','...',' ','&raquo;','&laquo;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','?','&raquo;','&laquo;');
									$item = str_replace($umlaute, $htmlcode, $item);
									$desc = str_replace($umlaute, $htmlcode, $desc);
								if($truncatetitle){
										if(strlen($item['title'])>55)
												{							$item['title']=substr($item['title'],0,55)." ... ";									}
								}
							echo wptexturize('<ul><li><a href="'.$href.'" title="'.$item['fulltitle'].'" >'.$item['title'].'</a></li></ul>');
								// Uncomment following line to also display headline description with each headline
								if($displaydescriptions && $desc<>"") { echo wptexturize("<div style=\"margin-left: 40px;\">"); echo wptexturize($desc.'</div>');}
								$display--;
				}
		 }
}

function Technorati($display=0,$displaydescriptions=false,$truncatetitle=true) {

$current_category = single_cat_title("", false);
$technofeed="http://feeds.technorati.com/feed/posts/tag/".$current_category ;
$technoicon="<a href='". $technofeed ."'><img src=\"http://technorati.com/favicon.ico\"></a>";

    if ( $technofeed ) {
    $rss = fetch_rss( $technofeed );

		echo wptexturize("<br />".$technoicon."<b>" . "Technorati" . "</b><br />");
				foreach ($rss->items as $item) {
								if ($display == 0) {
								break;
								}
								$href = $item['link'];
								$desc = trim($item['description']);
								$item['fulltitle']=$item['title'];
									$umlaute = array('�','�','�','�','�','�','�','�','�',"“","�?","’","–","—","…","&nbsp;",chr(196), chr(228),chr(214),chr(246),chr(220),chr(252),chr(223),chr(175),chr(174),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('?'),utf8_encode('�'),utf8_encode('�'));
									$htmlcode = array('&auml;','&ouml;','&uuml;','&szlig;','&Auml;','&Ouml;','&Uuml;','&raquo;','&laquo;','"','"','�','�','�','...',' ','&raquo;','&laquo;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','?','&raquo;','&laquo;');
									$item = str_replace($umlaute, $htmlcode, $item);
									$desc = str_replace($umlaute, $htmlcode, $desc);
								if($truncatetitle){
										if(strlen($item['title'])>55)
												{
														$item['title']=substr($item['title'],0,55)." ... ";
												}
								}
							echo wptexturize('<ul><li><a href="'.$href.'" title="'.$item['fulltitle'].'" >'.$item['title'].'</a></li></ul>');
								// Uncomment following line to also display headline description with each headline
								if($displaydescriptions && $desc<>"") { echo wptexturize("<div style=\"margin-left: 40px;\">"); echo wptexturize($desc.'</div>');}
								$display--;
				}
		 }
}

function Reddit($display=0,$displaydescriptions=false,$truncatetitle=true) {

$current_category = single_cat_title("", false);
$reddit="http://reddit.com/search.rss?q=".$current_category ;
$redditicon="<a href='". $reddit ."'><img src=\"http://reddit.com/static/spreddit/reddithead4.gif\"></a>" ;

    if ( $reddit ) {

    $rss = fetch_rss( $reddit );

		echo wptexturize("<br />" . $redditicon . "<b>" . Reddit . "</b><br />");

foreach ($rss->items as $item) {

		if ($display == 0) {
break;

								}

								$href = $item['link'];

								$desc = trim($item['description']);

								$item['fulltitle']=$item['title'];

									$umlaute = array('ÔøΩ','ÔøΩ','ÔøΩ','ÔøΩ','ÔøΩ','ÔøΩ','ÔøΩ','ÔøΩ','ÔøΩ',"‚Äú","ÔøΩ?","‚Äô","‚Äì","‚Äî","‚Ä¶","&nbsp;",chr(196), chr(228),chr(214),chr(246),chr(220),chr(252),chr(223),chr(175),chr(174),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'),utf8_encode('?'),utf8_encode('ÔøΩ'),utf8_encode('ÔøΩ'));

									$htmlcode = array('&auml;','&ouml;','&uuml;','&szlig;','&Auml;','&Ouml;','&Uuml;','&raquo;','&laquo;','"','"','ÔøΩ','ÔøΩ','ÔøΩ','...',' ','&raquo;','&laquo;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','?','&raquo;','&laquo;');

									$item = str_replace($umlaute, $htmlcode, $item);

									$desc = str_replace($umlaute, $htmlcode, $desc);

								if($truncatetitle){

										if(strlen($item['title'])>55)

												{

														$item['title']=substr($item['title'],0,55)." ... ";

												}

								}

							echo wptexturize('<ul><li><a href="'.$href.'" title="'.$item['fulltitle'].'" >'.$item['title'].'</a></li></ul>');

								// Uncomment following line to also display headline description with each headline

								if($displaydescriptions && $desc<>"") { echo wptexturize("<div style=\"margin-left: 40px;\">"); echo wptexturize($desc.'</div>');}

								$display--;
				}
		 }
}

function Digg($display=0,$displaydescriptions=false,$truncatetitle=true) {

$current_category = single_cat_title("", false);
$digg="http://digg.com/rss_search?search=".$current_category."&area=all&type=all&section=news";
$diggicon="<a href='". $digg ."'><img src=\"http://digg.com/favicon.ico\"></a>";

    if ($digg) {

    $rss = fetch_rss( $digg );

		echo wptexturize("<br />".$diggicon."<b>" . "Digg" . "</b><br />");
				foreach ($rss->items as $item) {
								if ($display == 0) {
								break;
								}
								$href = $item['link'];
								$desc = trim($item['description']);
								$item['fulltitle']=$item['title'];
									$umlaute = array('�','�','�','�','�','�','�','�','�',"“","�?","’","–","—","…","&nbsp;",chr(196), chr(228),chr(214),chr(246),chr(220),chr(252),chr(223),chr(175),chr(174),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('?'),utf8_encode('�'),utf8_encode('�'));
									$htmlcode = array('&auml;','&ouml;','&uuml;','&szlig;','&Auml;','&Ouml;','&Uuml;','&raquo;','&laquo;','"','"','�','�','�','...',' ','&raquo;','&laquo;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','?','&raquo;','&laquo;');
									$item = str_replace($umlaute, $htmlcode, $item);
									$desc = str_replace($umlaute, $htmlcode, $desc);
								if($truncatetitle){
										if(strlen($item['title'])>55)
												{
														$item['title']=substr($item['title'],0,55)." ... ";
												}
								}
							echo wptexturize('<ul><li><a href="'.$href.'" title="'.$item['fulltitle'].'" >'.$item['title'].'</a></li></ul>');
								// Uncomment following line to also display headline description with each headline
								if($displaydescriptions && $desc<>"") { echo wptexturize("<div style=\"margin-left: 40px;\">"); echo wptexturize($desc.'</div>');}
								$display--;
				}
		 }
	 }

function TailRank($display=0,$displaydescriptions=false,$truncatetitle=true) {

$current_category = single_cat_title("", false);
$tailrank="http://rss.tailrank.com/posts/find/?q=".$current_category;
$tailrankicon="<a href='". $tailrank ."'><img src=\"http://tailrank.com/favicon.ico\"></a>";

    if ($tailrank) {

    $rss = fetch_rss( $tailrank );

		echo wptexturize("<br />".$tailrankicon."<b>" . "TailRank" . "</b><br />");
				foreach ($rss->items as $item) {
								if ($display == 0) {
								break;
								}
								$href = $item['link'];
								$desc = trim($item['description']);
								$item['fulltitle']=$item['title'];
									$umlaute = array('�','�','�','�','�','�','�','�','�',"“","�?","’","–","—","…","&nbsp;",chr(196), chr(228),chr(214),chr(246),chr(220),chr(252),chr(223),chr(175),chr(174),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('�'),utf8_encode('?'),utf8_encode('�'),utf8_encode('�'));
									$htmlcode = array('&auml;','&ouml;','&uuml;','&szlig;','&Auml;','&Ouml;','&Uuml;','&raquo;','&laquo;','"','"','�','�','�','...',' ','&raquo;','&laquo;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','&Auml;','&auml;','&Ouml;','&ouml;','&Uuml;','&uuml;','&szlig;','?','&raquo;','&laquo;');
									$item = str_replace($umlaute, $htmlcode, $item);
									$desc = str_replace($umlaute, $htmlcode, $desc);
								if($truncatetitle){
										if(strlen($item['title'])>55)
												{
														$item['title']=substr($item['title'],0,55)." ... ";
												}
								}
							echo wptexturize('<ul><li><a href="'.$href.'" title="'.$item['fulltitle'].'" >'.$item['title'].'</a></li></ul>');
								// Uncomment following line to also display headline description with each headline
								if($displaydescriptions && $desc<>"") { echo wptexturize("<div style=\"margin-left: 40px;\">"); echo wptexturize($desc.'</div>');}
								$display--;
				}
		 }
	 }



// ###


function rssLinkListFilter($content) {

		return preg_replace_callback("/<!--rss:(.*)-->/", "rssMatcher", $content);
	}

	if(function_exists('add_filter')){
		add_filter('the_content', 'rssLinkListFilter');
	}


	function rssMatcher($matches) {
		// get the settings passed in
		$filterSetting = explode(",",$matches[1]);
		$params = array ('rss_feed_url' => $matches[1]);

		// determine if we have more than just a url
		/* loop over the array and break each element up into a sub array like:
				subArray[0] = key
				subArray[1] = value
			*/

		if(count($filterSetting) > 1){
			foreach ($filterSetting as $setting ) {
				$setting = explode(":=",$setting);
				$keyVal = $setting[0];
				$valVal = $setting[1];
				if($valVal == 'true' || $valVal == '1'){
					$valVal = true;
				} elseif ($valVal =='false' || $valVal == '0'){
					$valVal = false;
				}
				// make sure before and after tags are no longer escaped
				$valVal = html_entity_decode($valVal);

				$params[$keyVal] = $valVal;
			}
		} else {
			//handle the origional default settings for when the filter was first added to the plugin

			$params['display'] = 10;
			$params['displaydescriptions'] = true;
			$params['truncatetitle'] = false;
		}

	//return print_r($params);
	return RSSImport($params['display'],$params['rss_feed_url'],$params[''],$params['truncatetitle']);

}

						
?>