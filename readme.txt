=== WP-ExternalFeed ===
Contributors: androfire
Donate link: http://vagrantconcept.com/
Tags: rss, feed
Requires at least: 2.1
Tested up to: 2.3
Stable tag: 1.3

Displays links from del.icio.us, Technorati, Reddit, Digg and TailRank that is relevant to the current category of your blog

== Description ==

TDisplays links from del.icio.us, Technorati, Reddit, Digg and TailRank that is relevant to the current category of your blog. Eg: Your visitor browses the ‘humor’ category of your blog; the links will come from “http://del.icio.us/tags/humor” and so on. This means that you do not have to change any code for each specific category.

== Installation ==

1. Download plugin
2. Upload it to wp-content/plugins
3. Navigate to Plugins page and activate
4. Place code in the category.php file of your current theme, where you want the links displayed.
5. You’re done!

* For del.icio.us links: `<?php Delicious(10,false,false); ?>`
* For Technorati links: `<?php Technorati(10,false,false); ?>`
* For Reddit links: `<?php Reddit(10,false,false); ?>`
* For Digg links: `<?php Digg(10,false,false); ?>`
* For TailRank lnks: `<?php TailRank(10,false,false); ?>`

Parameters
Within the brackets, the first value specifies how many links you want to display, the second one specifies whether you want to display descriptions or not, and the third one truncates the title.

== Frequently Asked Questions ==

= Has there been a question asked yet? =

Nope. Please direct your questions to justinwongkh@gmail.com

== Screenshots ==

No screenshots at the moment
