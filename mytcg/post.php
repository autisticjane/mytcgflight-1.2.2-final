<?php require('check.php'); 
require_once('settings.php');
include('header.php');
	
	if (isset($_POST['submit'])) {

    $month = htmlspecialchars(strip_tags($_POST['month']));
    $date = htmlspecialchars(strip_tags($_POST['date']));
    $year = htmlspecialchars(strip_tags($_POST['year']));
    $time = htmlspecialchars(strip_tags($_POST['time']));
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $avatar = $_POST['avatar'];
    $entry = $_POST['entry'];

    $timestamp = strtotime($month . " " . $date . " " . $year . " " . $time);

    $entry = nl2br($entry);

    if (!get_magic_quotes_gpc()) {
        $title = addslashes($title);
        $entry = addslashes($entry);
    }

    $sql = "INSERT INTO my_blog (timestamp,title,entry,avatar) VALUES ('$timestamp','$title','$entry','$avatar')";

    $result = mysql_query($sql) or print("<p class=\"errormsg\">Can't insert into table my_blog.<br />" . $sql . "<br />" . mysql_error() . "</p>");

    if ($result != false) {
        print "<p class=\"success\">Your entry has successfully been entered into the database.</p>";
    }

    mysql_close();
}
?>

<?php
$current_month = date("F");
$current_date = date("d");
$current_year = date("Y");
$current_time = date("H:i");
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p><strong><label for="month">Date:</label></strong> 
<input type="text" name="date" id="date" size="2" value="<?php echo $current_date; ?>" />
<select name="month" id="month">
<option value="<?php echo $current_month; ?>"><?php echo $current_month; ?></option>
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
<option value="<?php echo $current_year; ?>"><?php echo $current_year; ?></option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>
<strong><label for="time">Time:</label></strong> <input type="text" name="time" id="time" size="5" value="<?php echo $current_time; ?>" /></p>

<p><strong><label for="title">Title:</label></strong> <input type="text" name="title" id="title" size="40" /></p>
<p><strong><label for="avatar">Icon:</label></strong> <input type="text" name="avatar" id="avatar" size="40" maxlength="100" /></p>
<p><textarea cols="80" rows="10" name="entry" id="entry">
</textarea></p>
<p><input type="submit" name="submit" id="submit" value="Submit"></p>
</form>

<?php
	include("footer.php");
?>