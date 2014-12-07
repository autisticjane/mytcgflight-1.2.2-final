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

include('footer.php'); ?>
