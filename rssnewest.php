<?php
//  ##############   Include Files  ################ //
	include "includes/ez_sql_core.php";
    include "includes/ez_sql_mysql.php";
    include "includes/db_connection.php";
	include "includes/functions.php";
//  ##############  Finish Includes  ############### //

// ###############  Setup Queries    ############### //
$recent = $db->get_results("SELECT * FROM addon ORDER BY created DESC LIMIT 5");
//  ##############  Finish Queries  ############### //

header("Content-type: text/xml"); 

echo "<?xml version='1.0' encoding='UTF-8'?> 
<rss version='2.0'>
<channel>
<title>Latest XBMC Add-Ons</title>
<link>http:addons.xbmc.org</link>
<description>Latest XBMC Add-Ons </description>
<language>en-us</language>"; 


// Build the Recent Add-Ons right hand slider slider
						foreach ($recent as $recents)
						{
							echo "<item>";
							echo "<title>".$recents->name."</title>";
							echo "<description>".$recents->description."</description>";
							echo "<date>".$recents->created."</date>";
							echo "</item>";
						}


 
echo "</channel></rss>"; 
?>