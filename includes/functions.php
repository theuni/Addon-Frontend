<?php
// PHP Functions //


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