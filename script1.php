<?php
include "connect.php"; //Connect to Database

	echo "
		<style>
		td{text-align:center;}
		</style>
		<table border='1'>
			<tr>
				<td>Campaign Name</td>
				<td>Adgroup Count</td>
				<td>Keyword Count</td>
				<td>Impression Total</td>
				<td>Clicks Total</td>
				<td>Cost Total</td>
			</tr>";
			
$query = "SELECT campaign, COUNT(adgroup.adgroupID) AS adgroupCount, COUNT(keywordID) AS keywordCount, SUM(impressions) AS impressionsTotal, SUM(clicks) AS clicksTotal, SUM(cost) AS costTotal FROM campaign, adgroup, keywords WHERE campaign.campaignID = adgroup.campaignID AND adgroup.adgroupID = keywords.adgroupID GROUP BY campaign.campaignID "; 
$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))

	{
		$campaign = $row['campaign'];
		$adgroupCount = $row['adgroupCount'];
		$keywordCount = $row['keywordCount'];
		$impressionsTotal = $row['impressionsTotal'];
		$clicksTotal = $row['clicksTotal'];
		$costTotal = $row['costTotal'];
		
		echo"
		<tr>
			<td>$campaign</td>
			<td>$adgroupCount</td>
			<td>$keywordCount</td>
			<td>$impressionsTotal</td>
			<td>$clicksTotal</td>
			<td>$costTotal</td>
		</tr>";
	}
	echo"</table>";

		
	
?>

