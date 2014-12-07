<?php require('check.php'); 
require_once('settings.php');
include('header.php');
if (isset($_POST['edit'])) {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $comment = nl2br($comment);
    $id = (int)$_POST['id'];

    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $comment = addslashes($comment);
    }

    $result = mysql_query("UPDATE my_blog_comments SET name='$name', comment='$comment' WHERE id='$id' LIMIT 1") or print ("Can't update comment.<br />" . $result . "<br />" . mysql_error());
    if ($result != false) {
        print "<p>The comment has successfully been edited!</p>";
    }
}

if(isset($_POST['delete'])) {
$id = (int)$_POST['id'];
     $result = mysql_query("DELETE FROM my_blog_comments WHERE id='$id' LIMIT 1") or print ("Can't delete comment.<br />" . $result . "<br />" . mysql_error());
     if ($result != false) {
         print "<p>The comment has successfully been deleted!</p>";
     }
}

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {

$result = mysql_query ("SELECT * FROM my_blog_comments WHERE id='$_GET[id]'") or print ("Can't select comment.<br />" . mysql_error());

while ($row = mysql_fetch_array($result)) {
      $old_name = stripslashes($row['name']);
      $old_comment = stripslashes($row['comment']);
      $old_comment = str_replace('<br />', '', $old_comment);
}

?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p><input type="hidden" name="id" id="id" value="<?php echo $_GET['id']; ?>">

    <strong><label for="name">Name:</label></strong> <input type="text" name="name" id="name" size="40" value="<?php echo $old_name; ?>" /></p>

    <p><strong><label for="comment">Comment:<label></strong><br />
    <textarea cols="80" rows="20" name="comment" id="comment"><?php echo $old_comment; ?></textarea></p>

    <p><input type="submit" name="edit" id="edit" value="Save Changes"> <input type="submit" name="delete" id="delete" value="Delete Comment"> <input type="submit" value="Never Mind"></p>

</form>
<?php

}
else {

	echo "<ul>";

$result = mysql_query("SELECT entry AS get_group FROM my_blog_comments GROUP BY get_group DESC LIMIT 10") or print ("Can't select comments.<br />" . $result . "<br />" . mysql_error());

while($row = mysql_fetch_array($result)) {
     $get_group = $row['get_group'];

     print "<li>";

    $result2 = mysql_query("SELECT timestamp, title FROM my_blog WHERE id='$get_group'");
    while($row2 = mysql_fetch_array($result2)) {
        $date = date("j M Y",$row2['timestamp']);
        $title = stripslashes($row2['title']);
        print "<strong>" . $date . "</strong> - <ul>";
    }

    $result3 = mysql_query("SELECT * FROM my_blog_comments WHERE entry='$get_group' ORDER BY timestamp DESC");
    while($row3 = mysql_fetch_array($result3)) {
        $id = $row3['id'];
        $name = stripslashes($row3['name']);
        $comment = stripslashes($row3['comment']);
        $date = date("d/m",$row3['timestamp']);

        if (strlen($comment) > 75 || strstr($comment, "<li>") || strstr($comment, "\n")) {
            $comment = substr($comment,0,75) . "...";
            $comment = str_replace("<br />", "", $comment);
            $comment = str_replace("\n", " ", $comment);
        }

        print "<li><a href=\"editcomments.php?id=" . $id . "\">" . $title . "</a> - " . $name . " @ " . $date;
        print "</li>";

    } echo("</ul>");
}
}
echo "</li></ul>" ;
mysql_close();
include("footer.php");
?>