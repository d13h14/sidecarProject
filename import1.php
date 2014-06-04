
<?php

include "connect.php"; //Connect to Database

mysql_query("
CREATE TABLE IF NOT EXISTS `test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `campaignID` text NOT NULL,
  `campaign` text NOT NULL,
  `adgroupID` text NOT NULL,
  `adgroup` text NOT NULL,
  `keywordID` text NOT NULL,
  `keyword` text NOT NULL,
  `clicks` text NOT NULL,
  `cost` text NOT NULL,
  `impressions` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;"); //Create temp table in DB

define('CSV_PATH','C:/xampp/htdocs/adwords/'); // path where your CSV file is located

$csv_file = CSV_PATH . "SampleKeywordReport.csv"; // Name of the CSV file
$csvfile = fopen($csv_file, 'r');

	//Import uploaded file to Database
	$handle = fopen($csv_file, 'r');

	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
		$import="INSERT into test(ID,campaignID,campaign,adgroupID,adgroup,keywordID,keyword,clicks,cost,impressions) values(NULL,'$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]')";

		mysql_query($import) or die(mysql_error());
	}

	fclose($handle);

	print "Import done";

	
mysql_query("DELETE FROM test WHERE ID =  1 ;"); //Delete header row from CSV file


/* Grab data from temp table and put into campaign table */

$query = "SELECT DISTINCT campaignID, campaign FROM test "; 
$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))

	{
		$campaignID = $row['campaignID'];
		$campaign = $row['campaign'];
		
		$queryResults=mysql_query("INSERT INTO campaign (`campaignID`, `campaign`) VALUES ('$campaignID', '$campaign') "); //Inserts into campaign table
	}

/* Grab data from temp table and put into adgroup table */
	
$query = "SELECT DISTINCT adgroupID, adgroup, campaignID FROM test ";
$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))

	{
		$adgroupID = $row['adgroupID'];
		$adgroup = $row['adgroup'];
		$campaignID = $row['campaignID'];
		
		$queryResults=mysql_query("INSERT INTO adgroup (`adgroupID`, `adgroup`, `campaignID`) VALUES ('$adgroupID', '$adgroup', '$campaignID') "); //Inserts into adgroup table
	}

/* Grab data from temp table and put into keyword table */
	
$query = "SELECT keywordID, keyword, adgroupID, clicks, cost, impressions FROM test ";
$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))

	{
		$keywordID = $row['keywordID'];
		$adgroupID = $row['adgroupID'];
		$keyword = $row['keyword'];
		$clicks = $row['clicks'];
		$cost = $row['cost'];
		$impressions = $row['impressions'];
		
		$queryResults=mysql_query("INSERT INTO keywords (`keywordID`, `adgroupID`, `keyword`, `clicks`, `cost`, `impressions`) VALUES ('$keywordID', '$adgroupID', '$keyword', '$clicks', '$cost', '$impressions') "); //Inserts into keyword table
	}

mysql_query("DROP TABLE test ;"); //Drop the temp table

?>
