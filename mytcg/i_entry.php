<?php
    $date = date("j M y", $row['timestamp']);

    $title = stripslashes($row['title']);
    $entry = stripslashes($row['entry']);
	
	$bbcode = array('[b]', '[i]', '[u]', '[/b]', '[/i]', '[/u]', '[center]', '[/center]');
	$bbcode_replace = array('<b>', '<i>', '<u>', '</b>', '</i>', '</u>', '<center>', '</center>');

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
	$formatted_entry = str_replace($bbcode, $bbcode_replace, stripslashes($row['entry']));
	$formatted_entry = str_replace($emoticons, $emoticons_replace, $formatted_entry); ?>