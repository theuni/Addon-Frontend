<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
//  ##############   Include Files  ################ //
	include "includes/ez_sql_core.php";
    include "includes/ez_sql_mysql.php";
    include "includes/db_connection.php";
	include "includes/functions.php";
//  ##############  Finish Includes  ############### //

//  ##############   Get Variables   ############### //
	$type = $_GET["t"];
//  ##############  Finish Varibles  ############### //

// ###############  Setup Queries    ############### //
$popular = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%Common%' ORDER BY downloads DESC LIMIT 5"); 
$recent = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' ORDER BY updated DESC LIMIT 5"); 
$newest = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' ORDER BY created DESC LIMIT 5"); 
$comment = $db->get_results("SELECT * FROM comment ORDER BY date DESC LIMIT 4"); 
$random = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' AND id NOT LIKE '%metadata.common%' ORDER BY RAND() DESC LIMIT 3"); 
$top5 = $db->get_results("SELECT *, COUNT( provider_name ) AS counttotal FROM addon GROUP BY provider_name ORDER BY counttotal DESC LIMIT 9");
$detail = $db->get_results("SELECT * FROM addon WHERE id = '$type'");
$commentaddon = $db->get_results("SELECT * FROM comment WHERE addonid = '$type' ORDER BY date DESC LIMIT 5");
//  ##############  Finish Queries  ############### //

?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />

	<link rel="stylesheet" href="stylesheets/dark.css" type="text/css" title="sky-blue" media="screen" />
	
	<style type="text/css">
		@import url(stylesheets/styles.css);			/*link to the main CSS file */
		@import url(stylesheets/ddsmoothmenu.css);		/*link to the CSS file for dropdown menu */
		@import url(stylesheets/tipsy.css);				/*link to the CSS file for tips */
	</style>
	
	<!-- Initialise jQuery Library -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	
	<!-- Cufon Font Generator Plugin -->
	<script type="text/javascript" src="js/cufon/cufon-yui.js"></script>
	<script type="text/javascript" src="js/cufon/MgOpen_Modata_400-MgOpen_Modata_700.font.js"></script>
	<script type="text/javascript" src="js/cufon/cufon-load.js"></script>

	<!-- jQuery Watermark Plugin -->
	<script type="text/javascript" src="js/jquery.watermarkinput.js"></script>
	
	<!-- DropDown Menu Plugin -->
	<script type="text/javascript" src="js/ddsmoothmenu.js"></script> 
	
	<!-- jQuery Image Fading plugin -->
	<script type="text/javascript" src="js/jquery.color.js"></script>
	
	<!-- jQuery Tabs -->
	<script type="text/javascript" src="js/ui.core.js"></script>
	<script type="text/javascript" src="js/ui.tabs.js"></script>
	
	<!-- jQuery TinyCarousel -->
	<script type="text/javascript" src="js/jquery.tinycarousel.min.js"></script>
	
	<!-- jQuery Tipsy -->
	<script type="text/javascript" src="js/jquery.tipsy.js"></script>
	
	<!-- jQuery autoAlign -->
	<script type="text/javascript" src="js/jquery.autoAlign.js"></script>

	<script type="text/javascript" src="js/custom.js"></script>

	<title>XBMC | Add-On Repository</title>
</head>
<body id="sp">
<!-- Begin Container -->
<div class="container">
	<!-- Begin Header -->
	<div id="header">
		<!-- Site Logo -->
		<a href="index.html" class="logo"><img src="images/logo.png"  alt="" /></a>
		<!-- SearchBox -->
		<form action="browse.php" id="searchform">
			<div>
				<label for="s" class="screen-reader-text">Search for:</label>
				<input type="text" id="t" name="t" value=""/>
				<input type="submit" value="Search" id="searchsubmit"/>
			</div>
		</form>
		<div class="clear"></div>
	</div>
	<!-- End Header -->
	<!-- Start Main Nav -->
	<?php 
	include "includes/header.php"; 
	?>
	<!-- End Main Nav -->
	<!-- Start Breadcrumbs -->
	<div id="breadcrumbs">
		<a href="index.php">Add-Ons</a> &raquo; 
		<span class="current">Details</span>
		<div class="clear"></div> 
	</div>
	<!-- End Breadcrumbs -->
	<!-- Start Page Title -->
	<div class="PageTitle">
		<h1>Add-Ons</h1>
	</div>
	<!-- End Page Title -->
	<!-- Start Content Wrapper -->
	<div id="content_wrapper_sbr">
		<!-- Content Area -->
		<div id="content">
			<!-- Content Box -->
			<div class="box">
				
				
				<?php 
					
						// Loop through the add-on details array
					if (isset($detail)) 
					{
						foreach ($detail as $details)
						{
							echo "<h2>$details->name ".$details->version."</h2>";
							echo "<table border='0' align='center'><tr><table cellspacing='28' class='transparenttable'><tr>";
							echo "<td>";
							echo "<img src='http://mirrors.xbmc.org/addons/eden/$details->id/icon.png' width='256' height='256' /><br>";
							echo "<br><b>Author:</b> <a href='/browse.php?a=".$details->provider_name."'>".$details->provider_name."</a>";
							echo "<br><br><b>Rating:</b> <img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' />";
							echo "<br><br><b>Downloads:</b> ".number_format($details->downloads);
							echo "<br><br><b>Description:</b> ".str_replace("[CR]","<br>",$details->description)."<br><br>";
							echo "<table align='center' width='500'class='transparenttable'><tr><td align='center'>";
							echo "<b>Forum Discussion:</b><br>";
						
						// Check forum link exists
							if (isset($details->forum)) 
							{ echo "<a href='".$details->forum."'><img src='images/forum.png' /></a>"; }
							else {echo "<img src='images/forumbw.png' />";}
						
						// Auto Generate Wiki Link
							echo " </td><td align='center'><b>Wiki Documentation:</b><br><a href='http://wiki.xbmc.org/index.php?title=Add-on:".$details->name."'><img src='images/wiki.png' /></a></td>";
						
						/* 
						// Donation stuff (**REMOVED FOR NOW**)
						echo "<td align='center'><b>Donate to Author:</b><br>";
						// Check donate link exists
						if (isset($details->donate)) 
						{
						echo "<a href='".$details->donate."'><img src='images/paypal.jpg' /></a>";
						}
						else {echo "<img src='images/paypalbw.jpg' />";} */
						
						// Check sourcecode link exists
						echo "<td align='center'><b>Source Code:</b><br>";
						if (isset($details->sourcecode)) 
						{
							echo "<a href='".$details->sourcecode."'><img src='images/code.png' /></a>";
						}
						else {echo "<img src='images/codebw.png' />";}
						
						echo "</td><tr></table><br><br>";

						}
					}
				//	Else {echo "none found"};
					
				?>

				
		<!-- Comments Javascript Livefyre Embed -->
		<div id="livefyre-comments"></div>
		<script type="text/javascript" src="http://zor.livefyre.com/wjs/v3.0/javascripts/livefyre.js"></script>
			<script type="text/javascript">
				(function () {
				var articleId = fyre.conv.load.makeArticleId(null, ['t']);
				fyre.conv.load({}, [{
				el: 'livefyre-comments',
				network: "livefyre.com",
				siteId: "314161",
				articleId: articleId,
				signed: false,
				collectionMeta: {
								articleId: articleId,
								url: fyre.conv.load.makeCollectionUrl(),
								}
				}], function() {});
				}());
			</script></td>
		<!-- END: Livefyre Embed -->
</tr></table></tr></table>
	
	<table width="610" class="transparenttable">
	  <tr>
	    <td align="center"><br></td>
      </tr>
	</table>

				<p>&nbsp;</p>
				<h2>Disclaimer</h2>
				<p>Although this is the official XBMC repository we take no liability for any of these plugins written by 3rd partist. We are not responsible for their content or application. Any problems please contact the foundation at the following email address. report@xbmc.org</p>
				
			</div>
		</div>
		<!-- Sidebar -->
		<div id="sidebar">
			
			<!-- Right hand top menu tabbed box -->
			<div class="widget-container">
				<!-- Start Tabbed Box Container -->
				<div id="tabs">
					<!-- Tabs Menu -->
					<ul id="tab-items">
						<li><a href="#tabs-1" title="Popular">Updated</a></li>
						<li><a href="#tabs-2" title="Recent">Newest</a></li>
						<li><a href="#tabs-3" title="Comments">Popular</a></li>
					</ul>
					<!-- Tab Container for menu with ID tabs-1 -->
					<div class="tabs-inner" id="tabs-1">
						<ul>
						
						<?php
						// Build the Recent Add-Ons right hand slider slider
						foreach ($recent as $recents)
						{
							echo "<li>";
							echo "<a href='details.php?t=".$recents->id."'><img src='http://mirrors.xbmc.org/addons/eden/$recents->id/icon.png' width='60' height='60'  class='pic alignleft' /></a>";
							echo "<b><a href='details.php?t=".$recents->id."'>$recents->name</a></b>";
							echo "<span class='date'>".$recents->updated."</span>";
							echo "<div class='clear'></div></li>";
						}
						?>
						</ul> 
					</div>
					<!-- Tab Container for menu with ID tabs-2 -->
					<div class="tabs-inner" id="tabs-2">
						<ul>
							
						<?php
						foreach ($newest as $newests)
						{
							echo "<li>";
							echo "<a href='details.php?t=".$newests->id."'><img src='http://mirrors.xbmc.org/addons/eden/$newests->id/icon.png' width='60' height='60'  class='pic alignleft' /></a>";
							echo "<b><a href='details.php?t=".$newests->id."'>$newests->name</a></b>";
							echo "<span class='date'>".$newests->created."</span>";
							echo "<div class='clear'></div></li>";
						}
						?>
						
						</ul>
					</div>
					<!-- Tab Container for menu with ID tabs-3 -->
					<div class="tabs-inner" id="tabs-3">
						<ul>
						<?php
					//	foreach ($comment as $comments)
					//	{
					//		echo "<li><b><a href='details.php?t=".$comments->addonid."'>".$comments->name." says '".$comments->comment."'</a></b>";
					//		echo "<span class='date'>".$comments->date."</span>";						
					//		echo "</li>";
					//	}
						// Build the Popular Add-Ons right hand slider slider
						foreach ($popular as $populars)
						{
							echo "<li><a href='blog_single.html'>";
							echo "<a href='details.php?t=".$populars->id."'><img src='http://mirrors.xbmc.org/addons/eden/$populars->id/icon.png' width='60' height='60'  class='pic alignleft' /></a>";
							echo "<b><a href='details.php?t=".$populars->id."'>$populars->name</a></b>";
							echo "<span class='date'>".number_format($populars->downloads)."</span>";
							echo "<div class='clear'></div></li>";
						}
						?>
						
						</ul>
					</div>
				</div>
				<!-- End Tabbed Box Container -->
			</div>
			<!-- Recent Projects Slider -->
			<div class="widget-container widget_recent_projects">
				<h2>Random Add-Ons</h2>
				<div class="carousel_container">
					<a class="buttons prev" href="#">left</a>
					<div class="viewport">
						<ul class="overview">
							
						<?php
						// Show some random Add-Ons
						foreach ($random as $randoms)
						{
							echo "<li><div class='thumb'><a href='details.php?t=".$randoms->id."'><img src='http://mirrors.xbmc.org/addons/eden/$randoms->id/icon.png' height='125' class='pic' /></a></div>";
							echo "<h5>".substr($randoms->name,0,22)." by ".substr($randoms->provider_name,0,15)."</h5>";
							echo "<p>".str_replace("[CR]","",substr($randoms->description,0,100))."...</p></li>";
						}
						?>
	
							
					
						</ul>
					</div>
					<a class="buttons next" href="#">right</a>
				</div>
				<div class="clear"></div>
			</div>


			<!-- Any Widget -->
			<div class="widget-container">
				<h2>Top Uploaders</h2>
				<ul>
					<?php
					$counter = 0;
					foreach ($top5 as $top5s)
					{
					$counter = $counter + 1;
						echo "<li>";
						if ($counter == 1) {echo "<img src='images/gold.png' height='20' width='20' /> ";}
						if ($counter == 2) {echo "<img src='images/silver.png' height='20' width='20' /> ";}
						if ($counter == 3) {echo "<img src='images/bronze.png' height='20' width='20' /> ";}
						if ($counter == 4) {echo "<img src='images/4.png' height='20' width='20' /> ";}
						if ($counter == 5) {echo "<img src='images/5.png' height='20' width='20' /> ";}
						if ($counter == 6) {echo "<img src='images/6.png' height='20' width='20' /> ";}
						if ($counter == 7) {echo "<img src='images/7.png' height='20' width='20' /> ";}
						if ($counter == 8) {echo "<img src='images/8.png' height='20' width='20' /> ";}
						if ($counter == 9) {echo "<img src='images/9.png' height='20' width='20' /> ";}
						echo "<a href='browse.php?a=$top5s->provider_name' title='August, 2010'>".substr($top5s->provider_name,0,15)." ($top5s->counttotal uploads)</a></li>";
					}
		
		?>
					
				
				</ul>
			</div>
	<!-- End Content Wrapper -->
		</div>
		<div class="clear"></div>
	</div>
	
	<?php 
	// Include the big bottom Footer
	include "includes/footer.php";
	?>
	
</div>
<!-- End Container -->
</body>
</html>