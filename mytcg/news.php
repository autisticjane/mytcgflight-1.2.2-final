<?php require('check.php'); 
require_once('settings.php');
include('header.php'); ?>
<h1>Update</h1>
&raquo; Do you want to <a href="post.php">post a new entry</a>?<br />
&raquo; Do you want to <a href="editcomments.php">edit comments</a>?

<h1>Edit an entry</h1>
<ul>
<?php $result = mysql_query("SELECT timestamp, id, title FROM my_blog ORDER BY id DESC");

while($row = mysql_fetch_array($result)) {
    $date  = date("l F d Y",$row['timestamp']);
    $id = $row['id'];
    $title = strip_tags(stripslashes($row['title']));

    if (mb_strlen($title) >= 20) {
        $title = substr($title, 0, 20);
        $title = $title . "...";
    }
    print("<li><a href=\"edit.php?id=" . $id . "\">" . $date . " -- " . $title . "</a></li>");
}
echo("</ul>"); ?>

<h1>Version Check</h1>
<?php
if (ini_get('allow_url_fopen') == '1') {
	$installed2 = file_get_contents('flight.txt');
	$version2 = file_get_contents('http://lizalawson.com/files/script-flight.txt');
	if ($version2 !== false) {
		if ($installed2 == $version2) { //version numbers are the same
			echo "<p>Your Flight hack is up to date.</p>";
		}
		else if ($installed2 != $version2) { //version numbers are not the same
			echo "<p>You are using Flight version ".$installed2.". Please update to <a href=\"http://lizalawson.tumblr.com/flight/\">Flight ".$version2."</a>.";
		}
	}
	else {
		// an error happened
		echo "Could not check for updates. Please make sure you use the latest version of <a href=\"http://lizalawson.tumblr.com/flight/\">Flight</a>.";
	}
}
else {
   echo "Could not check for updates. Please make sure you use the latest version of <a href=\"http://lizalawson.tumblr.com/flight/\">Flight</a>.";
}

include('footer.php'); ?>