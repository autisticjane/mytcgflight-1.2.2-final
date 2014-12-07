<?php
if (isset($_POST['submit_comment'])) {

    if (empty($_POST['name']) || empty($_POST['comment'])) {
        die("You have forgotten to fill in one of the required fields! Please make sure you submit a name, e-mail address and comment.");
    }

    $entry = htmlspecialchars(strip_tags($_POST['entry']));
    $timestamp = htmlspecialchars(strip_tags($_POST['timestamp']));
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $comment = nl2br($comment);

    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $comment = addslashes($comment);
    }

    mysql_connect ('localhost', 'db_username', 'db_password') ;
    mysql_select_db ('db_name');

    $result = mysql_query("INSERT INTO my_blog_comments (entry, timestamp, name, comment) VALUES ('$entry','$timestamp','$name','$comment')");

    header("Location: entry.php?id=" . $entry);
}
else {
    die("Error: you cannot access this page directly.");
}
?>
