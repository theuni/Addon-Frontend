<?php 

echo "test";


chdir('http://forum.xbmc.org'); // path to MyBB
define("IN_MYBB", 1);
require 'http://forum.xbmc.org/global.php';

if($mybb->user['uid'])
{
// The user is logged in, say Hi
echo "Hey, $mybbuser[username].<br>
Thanks for logging in.";
}

?>