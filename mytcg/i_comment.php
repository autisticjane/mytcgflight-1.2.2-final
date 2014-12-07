<?php   
$commenttimestamp = strtotime("now");

$sql = "SELECT * FROM my_blog_comments WHERE entry='$id' ORDER BY timestamp";
$result = mysql_query ($sql) or print ("Can't select comments from table ny_blog_comments.<br />" . $sql . "<br />" . mysql_error());
while($row = mysql_fetch_array($result)) {
    $timestamp = date("j M y", $row['timestamp']);
$bbcode = array('[b]', '[i]', '[u]', '[/b]', '[/i]', '[/u]');
$bbcode_replace = array('<b>', '<i>', '<u>', '</b>', '</i>', '</u>');

$emoticons = array(":)", ":(", ":x", ";)", ":P", ":o", ":heart:", "O.O", ":D", "-.-");
$emoticons_replace = array(
    '<img src="mytcg/imgs/smile.png" alt=":)" />',
    '<img src="mytcg/imgs/frown.png" alt=":(" />',
    '<img src="mytcg/imgs/x.png" alt=":x" />',
    '<img src="mytcg/imgs/wink.png" alt=";)" />',
    '<img src="mytcg/imgs/tongue.png" alt=":P" />',
    '<img src="mytcg/imgs/oh.png" alt=":o" />',
    '<img src="mytcg/imgs/heart.png" alt=":heart:" />',
    '<img src="mytcg/imgs/eyes.png" alt="O.O" />',
    '<img src="mytcg/imgs/grin.png" alt=":D" />',
    '<img src="mytcg/imgs/psh.png" alt="-.-" />'
);
$formatted_comment = str_replace($bbcode, $bbcode_replace, stripslashes($row['comment']));
$formatted_comment = str_replace($emoticons, $emoticons_replace, $formatted_comment);

    printf("<hr />");
	print("<p>" . $formatted_comment . "</p>");
    printf("<p>Comment by <a href=\"%s\">%s</a> @ %s</p>", stripslashes($row['url']), stripslashes($row['name']), $timestamp);
    printf("<hr />");
} ?>