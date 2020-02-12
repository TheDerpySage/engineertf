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

It simply parses the directory and filters output based on file names ending with '.dem'.

Easy enough.

TO-DO
======================
Improve formatting on demos.php

Create the blog.php system