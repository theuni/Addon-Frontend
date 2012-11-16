<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
//  ##############   Include Files  ################ //
	include "includes/ez_sql_core.php";
    include "includes/ez_sql_mysql.php";
    include "includes/db_connection.php";
	include "includes/functions.php";
//  ##############  Finish Includes  ############### //

//  ##############   Get Variables   ############### //
	if (isset($_GET["t"])) {$type = $_GET["t"];}
	if (isset($_GET["a"])) {$author = $_GET["a"];}
//  ##############  Finish Varibles  ############### //

// ###############  Setup Queries    ############### //
$popular = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%Common%' ORDER BY downloads DESC LIMIT 5"); 
$recent = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' ORDER BY updated DESC LIMIT 5"); 
$newest = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' ORDER BY created DESC LIMIT 5"); 
$comment = $db->get_results("SELECT * FROM comment ORDER BY date DESC LIMIT 4"); 
$random = $db->get_results("SELECT * FROM addon WHERE id NOT LIKE '%script.module%' AND id NOT LIKE '%metadata.common%' ORDER BY RAND() DESC LIMIT 3"); 
$top5 = $db->get_results("SELECT *, COUNT( provider_name ) AS counttotal FROM addon GROUP BY provider_name ORDER BY counttotal DESC LIMIT 9");
if ((isset($type))) 
{
$category = $db->get_results("SELECT * FROM addon WHERE id LIKE '%$type%' AND id NOT LIKE '%Common%' AND id NOT LIKE '%script.module%' ORDER BY downloads DESC");
$count = $db->get_var("SELECT count(*) FROM addon WHERE id LIKE '%$type%' AND id NOT LIKE '%Common%' AND id NOT LIKE '%script.module%'");
}
else if ((isset($author))) 
{
$category = $db->get_results("SELECT * FROM addon WHERE provider_name LIKE '%$author%' AND id NOT LIKE '%script.module%' ORDER BY downloads DESC");
$count = $db->get_var("SELECT count(*) FROM addon WHERE provider_name LIKE '%$author%' AND id NOT LIKE '%script.module%'");
}


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
		<span class="current">Browse</span>
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
				
				<h2>Browsing</h2>
				<p>
				<?php 
				if ((isset($type))) {echo $type;}
				if ((isset($author))) {echo $author;}
				?></p>
				
				<table border="0" align="center"><tr>
				<table cellspacing="28" class="transparenttable"> <tr>
				<?php
				$counter = 0;
				if (isset($category)) 
					{
					foreach ($category as $categories)
						{
						$counter = $counter +1;					
						echo "<td>";
						echo "<a href='details.php?t=".$categories->id."'><img src='http://mirrors.xbmc.org/addons/eden/$categories->id/icon.png' width='78' height='78' /></a><br>";
						echo "<b>".substr($categories->name,0,16)."</b>";
						echo "<br>".substr($categories->provider_name,0,17);
						echo "<br><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' /><img src='images/star_full_off.png' width='14' height='14' />";
						echo "</td>";
						if($counter % 4 == 0)
							{
							echo "</tr><tr>";
							}
						
						}
					}
					?>
				
						</tr>
		 		 </table></tr>
</table>
	<table width="610" class="transparenttable">
	  <tr>
	    <td align="center"><?php echo $count;?> Plugins found<br>
		
		
	
		
		</td>
      </tr>
	</table>

				
				<p>&nbsp;</p>
				<h2>Disclaimer</h2>
				<p>Although the is the official XBMC repository we take no liability for any of these plugins written by 3rd partist. We are not responsible for their content or application. Any problems please contact the foundation at the following email address. report@xbmc.org</p>
				
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
					
				<!--	<li><a href="#" title="August, 2010">Olympia (32 uploads)</a></li>
					<li><a href="#" title="July 2010">Zag (22 uploads)</a></li>
					<li><a href="#" title="June 2010">BlueCop (13 uploads)</a></li>
					<li><a href="#" title="April 2010">Fekker (05 uploads)</a></li>
					<li><a href="#" title="February 2010">Ajay (03 uploads)</a></li> -->
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