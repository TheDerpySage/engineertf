Engineer.tf Website
======================
A site made for engineer.tf paid for by Mothership808.

Design made with Bootstrap CSS, dynamic content generation with PHP.

blog.php
----------------------
Top blog posts are shown on the home page. Main blog page shows all posts. On those pages, they only render the first few lines.

Post titles link to the full render of that post. 

In this github, the blog directory contains the placeholder posts we'd made at the beginning. blog_example contains some test posts i'd made.

Every post is contained within its down directory thats named with the date YYYYMMDD, and they contain a markdown file. That markdown file's name is used for metadata purposes.

videos.php
----------------------
Videos posted to youtube may be embeded and played using this page.

videos.txt is read in by the script and all the videos in the file are displayed on the site. Videos can then be selected and played on the page.

Currently, the format for adding a new video to videos.csv is
`<youtube video ID>,<Title you want on the site>`

You can also search on the page and it will display results based on the given titles in the videos.txt file.

demos.php
----------------------
Demo files placed in the demos directory will be listed on this page.

They follow a strict naming scheme to be properly parsed.
`LEAGUE-FORMAT-DIV-SEASON-WEEK-MATCH_UP-YYYYMMDD-TIME-MAP-PART_OF[-MISSING].dem`

The included examples should give a better idea of what they should look like.
The MISSING field is only included in files where we are missing a part of an otherwise complete set.
It's for our audeince and us to understand where parts may be missing. 

It also includes a JSON file `seasons.json` of Teams names and their Shorthand by season so that the `MATCH_UP` part can be shorthanded in the file name.

Easy enough.

footer and nav.html
----------------------
These can be easily edited in one file, and those changes will reflect across all pages on the site.

TO-DO
======================

Create the blog.php system