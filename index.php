<?php
	include("mytcg/settings.php");
	include("$header");
	$blog_postnumber = 1;
	if(!isset($_GET['page'])) {
	$page = 1;
}
else {
	$page = (int)$_GET['page'];
}
$from = (($page * $blog_postnumber) - $blog_postnumber);
	$sql = "SELECT * FROM my_blog ORDER BY timestamp DESC LIMIT $from, $blog_postnumber";	$result = mysql_query($sql) or print ("Can't select entries from table my_blog.<br />" . $sql . "<br />" . mysql_error());
	while($row = mysql_fetch_array($result)) {
	include("mytcg/i_entry.php");
	$avatar = stripslashes($row['avatar']);
	$id = $row['id'];
	$result2 = mysql_query ("SELECT id FROM my_blog_comments WHERE entry='$id'");
	$num_rows = mysql_num_rows($result2);
    ?>
	
	<style>.avatar {float: right; text-align: center; padding: 5px;} .breakit {clear: both; height:4px;}
	</style>
					<h1><?php echo $title; ?></h1> <div class="avatar"><?php echo $date; ?><br />
<?php echo "<img src=\"/images/updates/$avatar.png\" />";?><br />
<?php 

        if ($num_rows > 0) {
            echo "<a href=\"entry.php?id=" . $id . "\">" . $num_rows . " comments</a>";
        }
        else {
            echo "<a href=\"entry.php?id=" . $id . "\">0 comments</a>";
        } ?></div>
					<p><?php echo $formatted_entry; ?></p>
					<p class="breakit"></p>


<p class="center"><?php
}
$total_results = mysql_fetch_array(mysql_query("SELECT COUNT(*) as num FROM my_blog"));
$total_pages = ceil($total_results['num'] / $blog_postnumber);
if ($page > 1) {
    $prev = ($page - 1);
    echo "<a href=\"index.php?page=$prev\">&lt;&lt;  Newer</a> ";
}
for($i = 1; $i <= $total_pages; $i++) {
    if ($page == $i) {
        echo "$i ";
        }
		else {
           echo "<a href=\"index.php?page=$i\">$i</a> ";
        }
}
if ($page < $total_pages) {
   $next = ($page + 1);
   echo "<a href=\"index.php?page=$next\">Older &gt;&gt;</a></p>";
}
echo("<p class=\"center\"><a href=\"archive.php\">archive</a></p>");
include("$footer");
?>