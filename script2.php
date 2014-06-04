<?php
include "connect.php"; //Connect to Database
?>
		<style>
		td{text-align:center;}
		</style>
<form name='adwords' method='post' action='script2.php'>
<select name='adgroup' style='width:150px;' onchange='this.form.submit()'>";
	<option value=''>Select an AdgroupID</option>
<?php				
		
$query = "SELECT DISTINCT adgroupID FROM adgroup ";
$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))

	{
		$adgroupID = $row['adgroupID'];
		
		echo"
			<option value='$adgroupID'>$adgroupID</option>";
	}

	echo "
		</select>
		</form>";

IF (!empty($_POST['adgroup'])) {
	$adgroupID = $_POST['adgroup'];
		echo"
		<table border='1'>
			<tr>
				<td colspan='6'>AdgroupID - $adgroupID</td>
			</tr>
			<tr>
				<td>Campaign Name</td>
				<td>Adgroup Count</td>
				<td>Keyword Count</td>
				<td>Impression Total</td>
				<td>Clicks Total</td>
				<td>Cost Total</td>
			</tr>";
			


$query = "SELECT campaign, adgroup, COUNT(keywordID) AS keywordCount, SUM(impressions) AS impressionsTotal, SUM(clicks) AS clicksTotal, SUM(cost) AS costTotal FROM adgroup, campaign, keywords WHERE campaign.campaignID=adgroup.campaignID AND adgroup.adgroupID=keywords.adgroupID AND adgroup.adgroupID = '$adgroupID' "; 
$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result))

	{
		$campaign = $row['campaign'];
		$adgroup = $row['adgroup'];
		$keywordCount = $row['keywordCount'];
		$impressionsTotal = $row['impressionsTotal'];
		$clicksTotal = $row['clicksTotal'];
		$costTotal = $row['costTotal'];
		
		echo"
		<tr>
			<td>$campaign</td>
			<td>$adgroup</td>
			<td>$keywordCount</td>
			<td>$impressionsTotal</td>
			<td>$clicksTotal</td>
			<td>$costTotal</td>
		</tr>";
	}
	echo"</table>";

} ELSE {

}

	
?>

