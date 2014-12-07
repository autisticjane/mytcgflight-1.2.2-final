<?php
include("mytcg/settings.php");
include("$header");

if (isset($_POST['submit_comment'])) {

    if (empty($_POST['name']) || empty($_POST['comment'])) {
        die("<p style=\"border:1px solid #999; background:#ddd url(\"mytcg/delete.png\") 2% 50% no-repeat;\">You have forgotten to fill in one of the required fields! Please make sure you submit a name and comment.</p>");
    }

    $entry = htmlspecialchars(strip_tags($_POST['entry']));
    $timestamp = htmlspecialchars(strip_tags($_POST['timestamp']));
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $url = htmlspecialchars(strip_tags($_POST['url']));
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $comment = nl2br($comment);

    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $url = addslashes($url);
        $comment = addslashes($comment);
    }

    $result = mysql_query("INSERT INTO my_blog_comments (entry, timestamp, name, url, comment) VALUES ('$entry','$timestamp','$name', '$url','$comment')");

    header("Location: entry.php?id=" . $entry);
}
else {
    die("<p style=\"border:1px solid #999; background:#ddd url(\"mytcg/delete.png\") 2% 50% no-repeat;\">Error: you cannot access this page directly.</p>");
}
include("$footer");?>