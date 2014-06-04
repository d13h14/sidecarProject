<?php
$db = mysql_connect("localhost", "root", "test123") or die("Could not connect.");
if(!$db) 
    die("no db");
if(!mysql_select_db("adwords",$db))
    die("No database selected.");
?>