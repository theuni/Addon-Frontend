<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
//  ##############   Include Files  ################ //
	include "includes/ez_sql_core.php";
    include "includes/ez_sql_mysql.php";
    include "includes/db_connection.php";
	include "includes/functions.php";
//  ##############  Finish Includes  ############### //

// ###############  Setup Queries    ############### //
$popular = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%Common%' ORDER BY downloads DESC LIMIT 4"); 
$recent = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' ORDER BY updated DESC LIMIT 5"); 
$newest = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' ORDER BY created DESC LIMIT 5"); 
$random = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' AND id NOT LIKE '%metadata.common%' ORDER BY RAND() DESC LIMIT 3"); 
$comment = $db->get_results("SELECT * FROM comment ORDER BY date DESC LIMIT 4"); 
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
		<form action="" id="searchform">
			<div>
				<label for="s" class="screen-reader-text">Search for:</label>
				<input type="text" id="s" name="s" value=""/>
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
	<!--<div id="breadcrumbs">
		<a href="#">Home</a> &raquo; 
		<a title="About" href="#">About</a> &raquo;
		<span class="current">About XBMC Add-Ons</span>
		<div class="clear"></div> 
	</div>-->
	<!-- End Breadcrumbs -->
	<!-- Start Page Title -->
	<div class="PageTitle">
		<h1>About Us</h1>
	</div>
	<!-- End Page Title -->
	<!-- Start Content Wrapper -->
	<div id="content_wrapper_sbr">
		<!-- Content Area -->
		<div id="content">
			<!-- Content Box -->
			<div class="box">
				
				<h2>Status</h2>
				<p>Syncing With Addons.XML</p>
				<p>
				<?php 
				# Check the XML exists
				$xml = simplexml_load_file('http://mirrors.xbmc.org/addons/eden/addons.xml');
				if (isset($xml->addon['id']))
					{
					$counter = 0;
					foreach ($xml->addon as $addons) 
						{	
						$counter = $counter + 1;
						$description = "";
							echo "<b>ID: </b>".$addons['id']. " - ";
							//echo "<b>Name: </b>".$addons['name']."<br>";
							//echo "<b>Provider Name: </b>".$addons['provider-name']."<br>";
							//echo "<b>Version: </b>".$addons['version']."<br>";
							//echo "<b>English Description: </b>";
							if ($addons->extension[1]->description != "") {$description = $addons->extension[1]->description;}
							if ($addons->extension[1]->description['lang'] == "en") {$description = $addons->extension[1]->description;};
							if ($addons->extension[1]->description[1]['lang'] == "en") {$description = $addons->extension[1]->description[1];};
							if ($addons->extension[1]->description[2]['lang'] == "en") {$description = $addons->extension[1]->description[2];};
							if ($addons->extension[1]->description[3]['lang'] == "en") {$description = $addons->extension[1]->description[3];};
							if ($addons->extension[1]->description[4]['lang'] == "en") {$description = $addons->extension[1]->description[4];};
							$id = $addons['id']; $name = addslashes($addons['name']); $provider_name = $addons['provider-name']; $version = $addons['version']; $description = addslashes($description);
							
							//Check here to see if the Item already exists
							$check = $db->get_row("SELECT * FROM addon WHERE id = '$id'"); 
							
							
							if (isset($check->id))
							{
								//Item exists
								echo "match found ";
								//Check here to see if the version number needs to be updated
								if ($check->version == $version) {echo "- versions the same";}
								// Update plugin here to new version number
								else {$db->query("UPDATE addon SET version = '$version', updated = NOW() WHERE id = '$id'"); echo "<b>version updated</b>";}
							}
							else if ($description != "")
							{
								$db->query("INSERT INTO addon (id, name, provider_name, version, description, created, updated) VALUES ('$id', '$name', '$provider_name','$version', '$description', NOW(), NOW())");
							}
							else {echo " no description found";}
							
							// check if screenshots.zip exists
								$screenshots = "http://mirrors.xbmc.org/addons/eden/".$id."/screenshots.zip";
								if(check_url("$screenshots")) {
									echo " - screenshot.zip found";
							 	}
								else {
									echo "";
								}
						
							
							
							//Insert into the database
							
							
						echo "<p>";
						}
					}
				
				// Now update the download stats
				$xmlsimple = simplexml_load_file('http://mirrors.xbmc.org/addons/addons_simplestats.xml');
				if (isset($xmlsimple->addon['id']))
					{
					foreach ($xmlsimple->addon as $addons2) 
						{	
						$downloads = $addons2->downloads;
						echo $addons2['id']." - ".$downloads;
						$id2 = $addons2['id'];
						
						$check2 = $db->get_row("SELECT * FROM addon WHERE id = '$id2'"); 
						if (isset($check2->id))
						// Plugin was found update with the downloads
						{
						$db->query("UPDATE addon SET downloads = '$downloads' WHERE id LIKE '$id2'"); echo "<b> downloads updated</b>";
						}
						echo "<br>";
						$check2 = "";
						}
					}
				
				?>
				
				</p>
				
				
			</div>
		</div>
		<!-- Sidebar -->
		<div id="sidebar">
			<!-- Widget Custom Menu
			<div class="widget_nav_menu">
				<h2>Custom Menu</h2>
				<ul>
					<li><a href="about.html" title="About Us">About Us</a></li>
					<li><a href="styles.html" title="xHTML Styles">xHTML Styles</a></li>
					<li><a href="fullwidth.html" title="Full Width &amp; Columns">Full Width &amp; Columns</a></li>
					<li><a href="portfolio.html" title="Portfolio Sortable">Portfolio Sortable</a></li>
					<li><a href="page.html" title="Ultra Clean Design">Ultra Clean Design</a></li>
					<li><a href="index-3.html" title="Flexibly Frontpage">Flexibly Frontpage</a></li>
				</ul>
			</div> -->
			<!-- Tabbed Box -->
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
						// Build the Popular Add-Ons right hand slider slider
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
				<h2>Featured Add-Ons</h2>
				<div class="carousel_container">
					<a class="buttons prev" href="#">left</a>
					<div class="viewport">
						<ul class="overview">
							<li>
								<div class="thumb"><a href="#"><img src="plugins\skin.aeon.nox\icon.png" height="125" alt="" class="pic" /></a></div>
								<h5>Aeon Nox by Big_Noid</h5>
								<p>Aeon Nox is a Skin based on the original Aeon by djh_. It takes it to a whole new level</p>
							</li>
							<li>
								<div class="thumb"><a href="#"><img src="plugins\plugin.video.revision3\icon.png" height="125" alt="" class="pic" /></a></div>
								<h5>revision3 by stacked</h5>
								<p>Revision3 is the leading independent free online video service that offers hit TV shows.</p>
							</li>
							<li>
								<div class="thumb"><a href="#"><img src="plugins\metadata.artists.theaudiodb.com\icon.png" height="125" alt="" class="pic" /></a></div>
								<h5>TheAudioDB by Zag</h5>
								<p>TheAudioDB.com is a community driven database of audio metadata. </p>
							</li>
						</ul>
					</div>
					<a class="buttons next" href="#">right</a>
				</div>
				<div class="clear"></div>
			</div>


			<!-- Any Widget -->
			<div class="widget-container">
				<h2>Top Add-on Creators</h2>
				<ul>
					<li><a href="#" title="August, 2010">Olympia (32 uploads)</a></li>
					<li><a href="#" title="July 2010">Zag (22 uploads)</a></li>
					<li><a href="#" title="June 2010">BlueCop (13 uploads)</a></li>
					<li><a href="#" title="April 2010">Fekker (05 uploads)</a></li>
					<li><a href="#" title="February 2010">Ajay (03 uploads)</a></li>
				</ul>
			</div>
	<!-- End Content Wrapper -->
		</div>
		<div class="clear"></div>
	</div>
	<!-- Start Footer Sidebar -->
	<div id="f_sidebar">
		<div class="sb_wrapper">
			<!-- Start First Collumn -->
			<div class="widget-container widget_text">
				<h3>About XBMC</h3>
				<p>XBMC is a free and open source media player application developed by the XBMC Foundation, a non-profit technology consortium. XBMC is available for multiple operating-systems and hardware platforms, featuring a 10-foot user interface for use with televisions and remote controls. It allows users to play and view most videos, music, podcasts, and other digital media files from local and network storage media and the internet.</p>
			</div>
			<!-- Start First Collumn -->
			<div class="widget-container">
				<h3>Internal Links</h3>
				<ul>
					<li><a href="#" title="Development Blog">Corporate Enquiries</a></li>
					<li><a href="#" title="XBMC Team">XBMC Foundation</a></li>
					<li><a href="#" title="XBMC Team">XBMC Team</a></li>
				</ul>
			</div>
			<!-- Start Second Collumn -->
			<div class="widget-container">
				<h3>External Links</h3>
				<ul>
					<li><a href="www.TheMovieDB.org" title="July 2010">TheMovieDB.org</a></li>
					<li><a href="www.TheTVDB.com" title="June 2010">TheTVDB.com</a></li>
					<li><a href="www.TheAudioDB.com" title="April 2010">TheAudioDB.com</a></li>
					<li><a href="www.Fanart.tv" title="February 2010">Fanart.tv</a></li>
					<li><a href="www.TheGamesDB.net" title="January 2010">TheGamesDB.net</a></li>
				</ul>
			</div>
			<!-- Start Third Collumn -->
			<div class="widget-container">
			<h3>Sponsors</h3>
				<ul>
					<li><a href="http://www.at-visions.com" title="At-Visons">At-Visons</a></li>
					<li><a href="http://www.convar.com/default.htm?language=1" title="Convar">Convar</a></li>
					<li><a href="http://www.pivosgroup.com/ title="Pivos">Pivos</a></li>
					<li><a href="http://www.wunderground.com/" title="WUnderground">Weather Underground</a></li>
				</ul>
			</div>
			<!-- Start 4th Collumn -->
			<div class="widget-container">
			<h3>Feeds</h3>
				<ul>
					<li><a href="http://xbmcpreview.explainstuff.net/comments/feed/" title="At-Visons">Add-On RSS</a></li>
					<li><a href="http://xbmcpreview.explainstuff.net/feed/" title="Comments RSS">Comments RSS</a></li>
					<li><a href="http://www.pivosgroup.com/ title="News RSS">News RSS</a></li>
				</ul>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!-- End Footer Sidebar -->
	<!-- Start Footer  -->
	
</div>
<!-- End Container -->
</body>
</html>