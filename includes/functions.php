<?php
// PHP Functions //


// Function to return the URL of the 1st Logo
function searchLogo($search)
{
$ftvxml = simplexml_load_file('http://fanart.tv/webservice/artist/7a3d390582c28a09616bfab3d86fa3e6/' . $search . '/xml/');
return $ftvxml->music->musiclogos->musiclogo[0]["url"];
}



//php function to check whether the url exists or not and validate it  
function check_url($url)  
{  
$check = @fopen($url,"r"); // we are opening url with fopen  
if($check)  
 $status = true;  
else  
 $status = false;  
   
return $status;  
}  
 


?>