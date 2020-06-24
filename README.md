Engineer.tf Website
======================
A site made for engineer.tf paid for by Mothership808.

Design made with Bootstrap CSS, dynamic content generation with PHP.

videos.php
----------------------
Videos posted to youtube may be embeded and played using this page.

videos.txt is read in by the script and all the videos in the file are displayed on the site. Videos can then be selected and played on the page.

Currently, the format for adding a new video to videos.txt is
`<youtube video ID>,<Title you want on the site>`

You can also search on the page and it will display results based on the given titles in the videos.txt file.

demos.php
----------------------
Demo files placed in the demos directory will be listed on this page.

They follow a strict naming scheme to be properly parsed.
`LEAGUE-FORMAT-DIV-SEASON-WEEK-MATCH_UP-YYYYMMDD-TIME-MAP-PART_OF.dem`

The included examples should give a better idea of what they should look like.

It also includes a JSON file `seasons.json` of Teams names and their Shorthand by season so that the `MATCH_UP` part can be shorthanded in the file name.

Easy enough.

TO-DO
======================

Create the blog.php system