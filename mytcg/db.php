<link rel="stylesheet" href="f.css" type="text/css" /><div id="dbcr">
<?php
/*
// This file prevents you from having to repeat this info!
// MySQL database info
// ASK YOUR HOST IF YOU ARE UNSURE!
// $db_server = typically localhost
// $db_database = the database
// $db_password = the database password
// $db_user = the database user
*/
	mysql_connect ('$db_server', '$db_user', '$db_password') ;
	mysql_select_db ('$db_database'); 

$sql = "CREATE TABLE my_blog (
  id int(20) NOT NULL auto_increment,
  timestamp int(20) NOT NULL,
  title varchar(255) NOT NULL,
  entry longtext NOT NULL,
  PRIMARY KEY  (id)
)";

$result = mysql_query($sql) or print ("<p class=\"error\">Can't create the table 'my_blog' in the database.<br />" . $sql . "<br />" . mysql_error());

$sql = "CREATE TABLE my_blog_comments (
  id int(20) NOT NULL auto_increment,
  entry int(20) NOT NULL,
  name varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  url varchar(255) NOT NULL,
  comment longtext NOT NULL,
  timestamp int(20) NOT NULL,
  PRIMARY KEY  (id)
)";

$result = mysql_query($sql) or print("<p class=\"error\">Can't create the table 'my_blog_comments' in the database.<br />" . $sql . "<br />" . mysql_error() . "</p>");

if ($result != false) {
    echo "<p class=\"success\">Table 'my_blog_comments' was successfully created. Delete this file from the server for security purposes.</p>";
}
$sql = "ALTER TABLE my_blog 
  ADD COLUMN avatar varchar(255) NOT NULL
";

$result = mysql_query($sql) or print ("<p class=\"error\">Can't alter the table 'my_blog' in the database.<br />" . $sql . "<br />" . mysql_error());

if ($result != false) {
    echo "Table 'my_blog' was successfully altered.<br />DELETE THIS FILE FROM YOUR SERVER."; }

mysql_close();

if ($result != false) {
    echo "Table 'my_blog' was successfully created.<br />DELETE THIS FILE FROM YOUR SERVER.";
}
?></div>