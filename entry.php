<?php 
include("mytcg/settings.php");
include("$header");

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID specified.");
}
	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM my_blog WHERE id='$id' LIMIT 1";
	$result = mysql_query($sql) or print ("Can't select entry from table my_blog.<br />" . $sql . "<br />" . mysql_error());
	while($row = mysql_fetch_array($result)) {
	include("mytcg/i_entry.php");
	    $avatar = stripslashes($row['avatar']);
	$result2 = mysql_query ("SELECT id FROM my_blog_comments WHERE entry='$id'");
	$num_rows = mysql_num_rows($result2);
    ?>
	<script language="javascript" type="text/javascript">
function addtext(text) {
     document.form.comment.value += text;
 }
 </script>
	<style>.avatar {float: right; text-align: center; padding: 5px;} .breakit {clear: both; height:4px;}
	/* clickable bbcode & smilies courtesy of nina21 @ exposure! */
.bbc {
	display: inline-block;
	text-align: center;
	padding: 2px;
	margin: 2px;
	letter-spacing:1px;
	background-color: #acacac;
	font: 14px "Trebuchet MS", sans-serif;
        color: #494a49;
	border: 1px solid #606060;
	width: 18px;
	height: 18px;
}
	</style>
					<h1><?php echo $title; ?></h1> <div class="avatar"><?php echo $date; ?><br />
<?php echo "<img src=\"images/updates/$avatar.png\" />";?><br /></div>
					<p><?php echo $formatted_entry; ?></p>
					<p class="breakit"></p>
	
	<h1><?php echo $num_rows; ?> comments</h1>
	        <?php
include("mytcg/i_comment.php");
?>
<h1>Leave a comment</h1>
<form method="post" name="form" action="process.php">
<p><input type="hidden" name="entry" id="entry" value="<?php echo $id; ?>" />
<input type="hidden" name="timestamp" id="timestamp" value="<?php echo $commenttimestamp; ?>">
<table width="50%"><tr><td><strong><label for="name">Name:</label></strong></td><td><input type="text" name="name"  style="width: 75%" id="name" size="25" /></td></tr>
<tr><td><strong><label for="url">Smilies:</label></strong></td><td>
<a href="#" onclick="addtext(':)'); return false"><img src="mytcg/imgs/smile.png" alt=":)" /></a>
<a href="#" onclick="addtext(':('); return false"><img src="mytcg/imgs/frown.png" alt=":(" /></a>
<a href="#" onclick="addtext(':x'); return false"><img src="mytcg/imgs/x.png" alt=":x" /></a>
<a href="#" onclick="addtext(';)'); return false"><img src="mytcg/imgs/wink.png" alt=";)" /></a>
<a href="#" onclick="addtext(':p'); return false"><img src="mytcg/imgs/tongue.png" alt=":P" /></a>
<a href="#" onclick="addtext(':o'); return false"><img src="mytcg/imgs/oh.png" alt=":o" /></a>
<a href="#" onclick="addtext(':heart:'); return false"><img src="mytcg/imgs/heart.png" alt=":heart:" /></a>
<a href="#" onclick="addtext('O.O'); return false"><img src="mytcg/imgs/eyes.png" alt="O.O" /></a>
<a href="#" onclick="addtext(':D'); return false"><img src="mytcg/imgs/grin.png" alt=":D" /></a>
<a href="#" onclick="addtext('-.-'); return false"><img src="mytcg/imgs/psh.png" alt="-.-" /></a>
</td></tr>
<tr><td><strong><label for="url">BBC Code:</label></strong></td><td>
<a href="#" onclick="addtext('[b]TEXT HERE[/b]'); return false" class="bbc"><b>B</b></a>
<a href="#" onclick="addtext('[i]TEXT HERE[/i]'); return false" class="bbc"><i>I</i></a>
<a href="#" onclick="addtext('[u]TEXT HERE[/u]'); return false" class="bbc"><u>U</u></a></td></tr>
<tr><td><strong><label for="comment">Comment:</label></strong></td><td>
<textarea cols="25" rows="5" style="width: 75%" name="comment" id="comment"></textarea></td></tr>
<tr><td></td><td><input type="submit" name="submit_comment" id="submit_comment" value="Add Comment" /></td></tr>
</form>
</table>

    <?php 
include("$footer");
} ?>