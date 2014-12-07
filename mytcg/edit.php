<?php require('check.php'); 
require_once('settings.php');

if (isset($_POST['update'])) {

    $id = htmlspecialchars(strip_tags($_POST['id']));
    $month = htmlspecialchars(strip_tags($_POST['month']));
    $date = htmlspecialchars(strip_tags($_POST['date']));
    $year = htmlspecialchars(strip_tags($_POST['year']));
    $time = htmlspecialchars(strip_tags($_POST['time']));
    $entry = $_POST['entry'];
    $avatar = $_POST['avatar'];
    $title = htmlspecialchars(strip_tags($_POST['title']));

    $entry = nl2br($entry);

    if (!get_magic_quotes_gpc()) {
        $title = addslashes($title);
        $entry = addslashes($entry);
    }

    $timestamp = strtotime ($month . " " . $date . " " . $year . " " . $time);

    $result = mysql_query("UPDATE my_blog SET timestamp='$timestamp', title='$title', entry='$entry', avatar='$avatar' WHERE id='$id' LIMIT 1") or print ("Can't update entry.<br />" . mysql_error());

    header("Location: ../entry.php?id=" . $id);

}

if (isset($_POST['delete'])) {
    $id = (int)$_POST['id'];
    $result = mysql_query("DELETE FROM my_blog WHERE id='$id'") or print ("<p class=\"error\"Can't delete entry.<br />" . mysql_error() . "</p>");
    if ($result != false) {
        print "<p class=\"success\">The entry has been successfully deleted from the database.</p>";
        exit;
    }
}

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid entry ID.");
}
else {
    $id = (int)$_GET['id'];
}

$result = mysql_query ("SELECT * FROM my_blog WHERE id='$id'") or print ("Can't select entry.<br />" . $sql . "<br />" . mysql_error());

while ($row = mysql_fetch_array($result)) {
    $old_timestamp = $row['timestamp'];
    $old_title = stripslashes($row['title']);
    $old_entry = stripslashes($row['entry']);
    $old_avatar = stripslashes($row['avatar']);
    $old_password = $row['password'];

    $old_title = str_replace('"','\'',$old_title);
    $old_entry = str_replace('<br />', '', $old_entry);

    $old_month = date("F",$old_timestamp);
    $old_date = date("d",$old_timestamp);
    $old_year = date("Y",$old_timestamp);
    $old_time = date("H:i",$old_timestamp);
}
include("header.php");
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><input type="hidden" name="id" value="<?php echo $id; ?>" />
<strong><label for="month">Date:</label></strong> 
<input type="text" name="date" id="date" size="2" value="<?php echo $old_date; ?>" />
<select name="month" id="month">
<option value="<?php echo $old_month; ?>"><?php echo $old_month; ?></option>
<option value="January">January</option>
<option value="February">February</option>
<option value="March">March</option>
<option value="April">April</option>
<option value="May">May</option>
<option value="June">June</option>
<option value="July">July</option>
<option value="August">August</option>
<option value="September">September</option>
<option value="October">October</option>
<option value="November">November</option>
<option value="December">December</option>
</select>
<select name="year" id="year">
<option value="<?php echo $old_year; ?>"><?php echo $old_year; ?></option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
<strong><label for="time">Time:</label></strong> <input type="text" name="time" id="time" size="5" value="<?php echo $old_time; ?>" /></p>
<p><strong><label for="title">Title:</label></strong> <input type="text" name="title" id="title" value="<?php echo $old_title; ?>" size="40" /></p>
<p><strong><label for="avatar">Icon:</label></strong>
<input type="text" name="avatar" id="avatar" size="40" maxlength="100" value="<?php echo $old_avatar; ?>" /></p>
<p><textarea cols="80" rows="20" name="entry" id="entry"><?php echo $old_entry; ?></textarea></p>
<p><input type="submit" name="update" id="update" value="Update"></p>
</form>
<p><strong>Before deleting, be absolutely sure - there is no confirmation nor is there any way to reverse deletion!</strong><br />
<small>(You may be shown your entry again after deleting - do not worry, it HAS been deleted.  Check the main page of the blog if you are still unsure.</small></p>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
<input type="submit" name="delete" id="delete" value="Yes, I am absolutely and positively sure I want to delete this entry." />
</form>

<?php
mysql_close();
include("footer.php");
?>