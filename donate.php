<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<?php
//  ##############   Include Files  ################ //
	include "includes/ez_sql_core.php";
    include "includes/ez_sql_mysql.php";
    include "includes/db_connection.php";
	include "includes/functions.php";
//  ##############  Finish Includes  ############### //

// ###############  Setup Queries    ############### //
$donation = $db->get_results("SELECT * FROM donation ORDER BY datemade DESC LIMIT 20"); 
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

	<title>XBMC | Donate</title>
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
	<div id="MainNav">
		<a href="http://xbmcpreview.explainstuff.net" title="Home" class="home_btn"><img  src="images/icon_home.gif" width="17" height="19" alt="Home" /></a>
		<div id="menu">
			<ul class="ddsmoothmenu">
				<li><a href="http://xbmcpreview.explainstuff.net/home" title="About">About</a></li>
				<li><a href="http://xbmcpreview.explainstuff.net/download" title="Download">Download</a></li>
				<li><a href="http://xbmcrepo.explainstuff.net/" title="Add-Ons">Add-Ons</a></li>
				<li><a href="http://theworldaccordingtosue.com/mediawiki119/index.php?title=Main_Page" title="Wiki">Wiki</a></li>
				<li><a href="http://forum.xbmc.org" title="Forum">Forum</a></li>
				<li class="current-menu-item"><a href="http://xbmcrepo.explainstuff.net/donate.php" title="Skins">Donate</a></li>
			</ul>
		</div>
		<!-- Start Social Icons -->
		<ul class="social">
			<li><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=donate%40xbmc%2eorg&lc=US&item_name=XBMCDonation&no_note=1&no_shipping=1&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donate_LG%2egif%3aNonHosted" class="ico_donate" title="Donate"></a></li>
			<li><a href="#" class="ico_myspace" title="GooglePlus"></a></li>
			<li><a href="#" class="ico_facebook" title="Facebook"></a></li>
			<li><a href="#" class="ico_twitter" title="Twitter"></a></li>
		</ul>
		<!-- End Social Icons -->
		<div class="clear"></div>
	</div>
	<!-- Start Page Title -->
	<div class="PageTitle">
		<h1>Donate to XBMC</h1>
	</div>
	<!-- End Page Title -->
	<!-- Start Content Wrapper -->
	<div id="content_wrapper_sbr">
		<!-- Content Box -->
		<div class="box">
			
				
				

	<!-- Main Donation Form START -->
	<div id="main">
	<div>
    <div>
  
<div style="float: right; padding: 0px; margin: 0px;">

<form class="contrib" action="https://www.paypal.com/cgi-bin/webscr" method="post">
<div style="margin:0 1em 0 .5em; border: 2px solid #aaa; padding: 1em; float: left; background-color: #fafafa; clear: left; cursor: default;">

<input type="hidden" name="business" value="donate@xbmc.org" />
<input type="hidden" name="item_name" value="One time donation" />
<input type="hidden" name="item_number" value="DONATE" />
<input type="hidden" name="no_note" value="0" />
<input type="hidden" name="cmd" value="_xclick" />
<input type="hidden" name="on1" value="Comment" />
<input type="hidden" name="lc" value="en" />
<input type="hidden" name="on0" value="Anonymity" />

<table style="background-color: transparent; width: 280px;" cellpadding="5">
<tr>
<td width="30%"><label for="don-amount"><b>One time gift of</b></label></td>
<td width="70%">
<input type="text" name="amount" id="don-amount" maxlength="30" size="5" />
<select name="currency_code">
<option value="USD" selected="selected">$ (USD)</option>
</select>
</td></tr>
<tr>
<td width="30%" valign="top"><b>Public donor list</b></td>
<td width="70%">
<input type="radio" name="os0" id="name-yes" value="Mention my name" />
<label for="name-yes">List my name</label><br/>
<input type="radio" name="os0" id="name-no" checked="checked" value="Don't mention my name" />
<label for="name-no">List anonymously</label>
</td></tr>
<tr>
<td width="30%"><input class="centered" type="submit" value="Donate Now!" onclick="_gaq.push(['_trackEvent', 'Donations', 'Submit button pressed'])" /></td>
</tr>
<tr>
<td width="70%" colspan="2"><img src="http://upload.wikimedia.org/wikipedia/foundation/7/78/Credit_cards.png" alt="Visa, MasterCard, Discover, American Express, eCheck" /></td>
</tr>
</table>
</div>
</form>
</div>

				<p><b>Why donate money?</b> XBMC is free, open source software that requires no payment to download or use. It is funded by donations from its users and sponsorship from commercial companies. It is our aim to be entirely self-sufficient as an organization which will allow us to improve the software year after year.</b>

				<p><b>How is the money used?</b> The money is used to finance the non-profit XBMC foundation. This covers things like developer conferences, travel expenses, web hosting and occasional developer hardware</b>

				<p><b>How much should you give?</b> This is entirely up to you, give what you think the software is worth, or maybe just a donation to help us along. Large or small, all donations contribute to the success of the project.</b>

				<p><b>What do I get in return?</b> We currently give any donator who contributes over $50 a special badge on the forum for being a "supporter". We also list your name on the donations page.
				
				
  </div>
  </div>

</div>
        <!-- main END -->
				
			<img src='/images/transparent.png' width=32>
				<p>
				<h2>Recent Donations</h2>
				<?php 
				# Check the last 20 donations
				
				echo "<table width='950'><tbody><tr><th align='center'>Date</th><th align='center'>Country</th align='center'><th align='center'>Donor</th><th align='center'>Amount</th><th align='center'>Message</th></tr>";
				
				foreach ($donation as $donations)
						{
							echo "<td align='center'>".date(  "j F, Y", strtotime( $donations->datemade ) )."</td>";
							echo "<td align='center'><img src='/images/flags/". $donations->country. ".gif' width='30' height='22' /></td>";
							echo "<td align='center'>$donations->donor</td>";
							echo "<td align='center'>$".number_format($donations->amount)."</td>";
							echo "<td align='center'>$donations->message</td></tr>";
						}
				echo "</tbody></table>";
				?>
				
				</p>
				
			
		
		
	</div>
	<!-- End Content Wrapper -->
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